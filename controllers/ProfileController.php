<?php

require_once '../models/user.php';
require_once '../private/database.php';
require_once '../utils/clean-input.php';
require_once '../utils/messages-manager.php';
require_once '../utils/regex-manager.php';
require_once '../utils/validate-image.php';


class ProfileController
{
    public function profile()
    {
        // INSTANTIATION DE LA CLASSE MessageManager POUR GERER LES MESSAGES //
        $messageManager = new MessageManager();

        // SI L'UTILISATEUR N'EST PAS CONNECTÉ, ON LE REDIRIGE VERS LA PAGE DE CONNEXION //
        if(!isset($_SESSION['user'])) {
            $_SESSION['warning'] = $messageManager->getMessage('error', 'must_be_logged_in');
            header('Location: /connexion');
            exit;
        }

        // ON RÉCUPÈRE L'ID DE L'UTILISATEUR CONNECTÉ //
        $userId = $_SESSION['user']['id'];

        // ON INSTANCIE LA CLASSE Users POUR RÉCUPÉRER LES INFORMATIONS DE L'UTILISATEUR //
        $user = new Users();

        // ON RÉCUPÈRE LES INFORMATIONS DE L'UTILISATEUR GRÂCE À SON ID //
        $user->setId($userId);
        $userData = $user->getUserById();

        // ON AFFICHE LA VUE DE LA PAGE DE PROFIL //
        require_once '../views/elements/header.php';
        require_once '../views/pages/account/profile.php';
        require_once "../views/elements/footer.php";
    }


    public function updateProfile()
    {
        // INITIALISE UNE NOUVELLE SESSION //
        $user = new Users();
        $user->setId($_SESSION['user']['id']);


        // INSTANTIATION DE LA CLASSE MessageManager POUR GERER LES MESSAGES //
        $messageManager = new MessageManager();
        // INSTANTIATION DE LA CLASSE RegexManager POUR UTILISER LES EXPRESSIONS RÉGULIÈRES //
        $regexManager = new RegexManager();
        // ON INITIALISE LE TABLEAU DES ERREURS //
        $errors = [];

        // SI LE SERVEUR REÇOIT UNE REQUÊTE POST //
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // VALIDATION DU NOM D'UTILISATEUR //
            if (isset($_POST['username'])) {
                $username = cleanInput($_POST['username']);
                $user->setUsername($username);
                if (!preg_match($regexManager->getRegex('username'), $username)) {
                    $errors['username'] = $messageManager->getMessage('error', 'username_invalid');
                } elseif ($user->checkUsernameAlreadyUse()) {
                    $errors['username'] = $messageManager->getMessage('error', 'username_exists');
                } elseif (strlen($username) < 3) {
                    $errors['username'] = $messageManager->getMessage('error', 'username_minlength');
                } elseif (strlen($username) > 30) {
                    $errors['username'] = $messageManager->getMessage('error', 'username_maxlength');
                }
            }

            // VALIDATION DE LA DATE DE NAISSANCE //
            if (isset($_POST['birthdate'])) {
                $birthdate = cleanInput($_POST['birthdate']);
                if (!preg_match($regexManager->getRegex('date'), $birthdate)) {
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
            }

            // VALIDATION DE L'EMAIL //
            if (isset($_POST['email'])) {
                $email = cleanInput($_POST['email']);
                $user->setEmail($email);
                if (!preg_match($regexManager->getRegex('email'), $email)) {
                    $errors['email'] = $messageManager->getMessage('error', 'email_invalid');
                } elseif ($user->checkEmailAlreadyUse()) {
                    $errors['email'] = $messageManager->getMessage('error', 'email_exists');
                }
            }


            // VALIDATION DU NUMÉRO DE TÉLÉPHONE //
            if (isset($_POST['phone'])) {
                $phone = cleanInput($_POST['phone']);
                if (!preg_match($regexManager->getRegex('phone'), $phone)) {
                    $errors['phone'] = $messageManager->getMessage('error', 'phone_invalid');
                }
            }

            // VALIDATION DE LA TRIBU //
            if (isset($_POST['tribe'])) {
                $tribe = cleanInput($_POST['tribe']);
                if (strlen($tribe) > 25) {
                    $errors['tribe'] = $messageManager->getMessage('error', 'tribe_maxlength');
                }
            }

            // VALIDATION DE LA DESCRIPTION //
            if (isset($_POST['description'])) {
                $description = cleanInput($_POST['description']);
                if (strlen($description) > 150) {
                    $errors['description'] = $messageManager->getMessage('error', 'description_maxlength');
                }
            }


            // VALIDATION DE LA SIGNATURE //
            if (isset($_POST['signature'])) {
                $signature = cleanInput($_POST['signature']);
                if (strlen($signature) > 50) {
                    $errors['signature'] = $messageManager->getMessage('error', 'signature_maxlength');
                }
            }

            // SI AUCUNE ERREUR N'A ÉTÉ TROUVÉE, PROCÉDEZ À LA MISE À JOUR DU PROFIL //
            if (empty($errors)) {
                // UTILISEZ LES SETTERS POUR DÉFINIR LES VALEURS DES PROPRIÉTÉS DE L'UTILISATEUR
                $user->setEmail($email);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setBirthdate($birthdate);
                $user->setTribe($tribe);
                $user->setPhone($phone);
                $user->setDescription($description);
                $user->setAvatar($avatar);
                $user->setSignature($signature);

                // TENTE D'ENREGISTRER L'UTILISATEUR DANS LA BASE DE DONNÉES //
                $result = $user->updateProfile();

                // SI L'ENREGISTREMENT A RÉUSSI //
                if ($result) {
                    // REDIRIGE VERS LA PAGE DE PROFIL AVEC UN MESSAGE DE SUCCÈS //
                    $_SESSION['success'] = $messageManager->getMessage('success', 'registered');
                    header('Location: /profil');
                    // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
                    exit();
                } else {
                    // SI L'ENREGISTREMENT A ÉCHOUÉ, AFFICHE UN MESSAGE D'ERREUR ET REDIRIGE VERS LA PAGE PROFIL //
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
                    header('Location: /profil');
                    // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
                    exit();
                }
            }
        }
            var_dump($_POST);
        // SI ON A DES ERREURS, ON LES AFFICHE //
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        }
        // ON AFFICHE LA VUE DE LA PAGE DE PROFIL //
        require_once '../views/elements/header.php';
        require_once '../views/pages/account/profile.php';
        require_once "../views/elements/footer.php";
    }
}
