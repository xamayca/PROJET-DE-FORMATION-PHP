<?php
require_once '../models/user.php';
require_once '../private/database.php';
require_once '../utils/clean-input.php';
require_once '../utils/messages-manager.php';
require_once '../utils/regex-manager.php';

class RegistrationController
{
    // LOGIQUE POUR ENREGISTRER L'UTILISATEUR DANS LA BASE DE DONNÉES & GÉRER LES ERREURS //
    public function registration()
    {
        // INSTANCIATION DE LA CLASSES MessageManager POUR GERER LES MESSAGES //
        $messageManager = new MessageManager();
        // INSTANCIATION DE LA CLASSE RegexManager POUR UTILISER LES EXPRESSIONS RÉGULIÈRES //
        $regexManager = new RegexManager();
        // TABLEAU POUR STOCKER LES ERREURS //
        $errors = [];

        // INSTANCIATION DE LA CLASSE Users POUR UTILISER LES MÉTHODES DE LA CLASSE //
        $user = new Users();

        // SI LE SERVEUR REÇOIT UNE REQUÊTE POST //
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // NETTOYAGE DES DONNÉES REÇUES
            foreach ($_POST as $key => $value) {
                $$key = cleanInput($value);
            }

            // AFFECTATION DES DONNÉES NETTOYÉES AUX PROPRIÉTÉS DE L'OBJET USER
            $user->setUsername($username);
            // VALIDATION DU NOM D'UTILISATEUR //
            if (empty($username)) {
                $errors['username'] = $messageManager->getMessage('error', 'username_required');
            } elseif (!preg_match($regexManager->getRegex('username'), $username)) {
                $errors['username'] = $messageManager->getMessage('error', 'username_invalid');
            } elseif ($user->checkUsernameAlreadyUse()) {
                $errors['username'] = $messageManager->getMessage('error', 'username_exists');
            } elseif (strlen($username) < 3) {
                $errors['username'] = $messageManager->getMessage('error', 'username_minlength');
            } elseif (strlen($username) > 30) {
                $errors['username'] = $messageManager->getMessage('error', 'username_maxlength');
            }

            // AFFECTATION DES DONNÉES NETTOYÉES AUX PROPRIÉTÉS DE L'OBJET USER
            $user->setEmail($email);
            // VALIDATION DE L'EMAIL //
            if (empty($email)) {
                $errors['email'] = $messageManager->getMessage('error', 'email_required');
            } elseif (!preg_match($regexManager->getRegex('email'), $email)) {
                $errors['email'] = $messageManager->getMessage('error', 'email_invalid');
            } elseif ($user->checkEmailAlreadyUse()) {
                $errors['email'] = $messageManager->getMessage('error', 'email_exists');
            }

            // VALIDATION DU MOT DE PASSE //
            if (empty($password)) {
                $errors['password'] = $messageManager->getMessage('error', 'password_required');
            } elseif (!preg_match($regexManager->getRegex('password'), $password)) {
                $errors['password'] = $messageManager->getMessage('error', 'password_invalid');
            } elseif (strlen($password) < 8) {
                $errors['password'] = $messageManager->getMessage('error', 'password_minlength');
            }

            // VALIDATION DE LA CONFIRMATION DU MOT DE PASSE //
            if (empty($password_confirm)) {
                $errors['password_confirm'] = $messageManager->getMessage('error', 'password_confirm_required');
            } elseif ($password !== $password_confirm) {
                $errors['password_confirm'] = $messageManager->getMessage('error', 'password_confirm_invalid');
            }

            // VALIDATION DE LA DATE DE NAISSANCE //
            if (empty($birthdate)) {
                $errors['birthdate'] = $messageManager->getMessage('error', 'birthdate_required');
            } elseif (!preg_match($regexManager->getRegex('date'), $birthdate)) {
                $errors['birthdate'] = $messageManager->getMessage('error', 'birthdate_invalid');
            } else {
                // CONVERTIS LA DATE DE NAISSANCE EN OBJET DATETIME //
                $birthdateObject = new DateTime($birthdate);
                $today = new DateTime();
                $age = $today->diff($birthdateObject)->y;

                // SI L'AGE EST INFERIEUR A 10 ANS OU SUPERIEUR A 100 ANS ON AFFICHE UNE ERREUR //
                if ($age < 10 || $age > 100) {
                    $errors['birthdate'] = $messageManager->getMessage('error', 'age_invalid');
                }
            }

            // ENREGISTREMENT DE L'UTILISATEUR DANS LA BASE DE DONNÉES //
            if (empty($errors)) {
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setBirthdate($birthdate);

                // APPEL DE LA MÉTHODE create() POUR ENREGISTRER L'UTILISATEUR DANS LA BASE DE DONNÉES //
                $result = $user->create();

                if ($result) {
                    // SI L'UTILISATEUR S'ENREGISTRE AVEC SUCCÈS ON LE REDIRIGE VERS LA PAGE DE CONNEXION //
                    $_SESSION['success'] = $messageManager->getMessage('success', 'registered');
                    header('Location: /connexion');
                    // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
                    exit();
                } else {
                    // SINON ON AFFICHE UN MESSAGE D'ERREUR ET ON LE REDIRIGE VERS LA PAGE D'ACCUEIL //
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
                    header('Location: /');
                    // FIN DE L'EXECUTION DU SCRIPT //
                    exit();
                }
            }
        }
        // AFFICHAGE DE LA PAGE D'ENREGISTREMENT //
        require_once "../views/elements/header.php";
        require_once '../views/pages/account/registration.php';
    }
}
