<?php

require_once '../models/user.php';
require_once '../private/database.php';
require_once '../utils/clean-input.php';
require_once '../utils/messages-manager.php';
require_once '../utils/regex-manager.php';

class LoginController
{
    public function login()
    {
        // INSTANCIATION DE LA CLASSES MessageManager POUR GERER LES MESSAGES //
        $messageManager = new MessageManager();
        // INSTANCIATION DE LA CLASSE RegexManager POUR UTILISER LES EXPRESSIONS RÉGULIÈRES //
        $regexManager = new RegexManager();
        // ON INITIALISE LE TABLEAU DES ERREURS //
        $errors = [];

        // SI LE SERVEUR REÇOIT UNE REQUÊTE POST //
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // INITIALISE UNE NOUVELLE SESSION //
            $user = new Users();
            $email = cleanInput($_POST['email']);
            $password = cleanInput($_POST['password']);

            // VALIDATION DE L'EMAIL //
            if (empty($email)) {
                $errors['email'] = $messageManager->getMessage('error', 'email_required');
            } elseif (!preg_match($regexManager->getRegex('email'), $email)) {
                $errors['email'] = $messageManager->getMessage('error', 'email_invalid');
            }

            // VALIDATION DU MOT DE PASSE //
            if (empty($password)) {
                $errors['password'] = $messageManager->getMessage('error', 'password_required');
            } elseif (!preg_match($regexManager->getRegex('password'), $password)) {
                $errors['password'] = $messageManager->getMessage('error', 'password_invalid');
            }

            // S'IL N'Y A PAS D'ERREURS, ON CONTINUE //
            if (empty($errors)) {

                // ON RECUPERE LES INFOS DE L'UTILISATEUR AVEC SON EMAIL //
                $user->setEmail($email);
                $userData = $user->getUserByEmail();

                // SI LE MOT DE PASSE CORRESPOND, ON CONNECTE L'UTILISATEUR //
                if (isset($userData['password']) && password_verify($password, $userData['password'])) {

                    // ON STOCKE LES INFOS DE L'UTILISATEUR DANS LA SESSION //
                    $_SESSION['user'] = [
                        'id' => $userData['id'],
                        'username' => $userData['username'],
                        'email' => $userData['email'],
                    ];

                    // SI LA CONNEXION EST REUSSIE, ON REDIRIGE VERS LA PAGE D'ACCUEIL AVEC UN MESSAGE ET SON NOM D'UTILISATEUR //
                    $_SESSION['success'] = str_replace('{{username}}', $userData['username'], $messageManager->getMessage('success', 'logged_in'));
                    header('Location: /');
                    // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
                    exit;
                } else {
                    // ON VERIFIE SI LE MOT DE PASSE EST INCORRECT //
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'invalid_credentials');
                }
            }
        }

        // SI ON A DES ERREURS, ON LES AFFICHE //
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        }
        // ON AFFICHE LA VUE DE LA PAGE DE CONNEXION //
        require_once '../views/elements/header.php';
        require_once '../views/pages/account/login.php';
        require_once "../views/elements/footer.php";
    }
}
