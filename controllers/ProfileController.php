<?php

require_once '../models/user.php';
require_once '../private/database.php';
require_once '../utils/clean-input.php';
require_once '../utils/messages-manager.php';
require_once '../utils/regex-manager.php';


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
        // INSTANTIATION DE LA CLASSE MessageManager POUR GERER LES MESSAGES //
        $messageManager = new MessageManager();
        // INSTANTIATION DE LA CLASSE RegexManager POUR UTILISER LES EXPRESSIONS RÉGULIÈRES //
        $regexManager = new RegexManager();
        // ON INITIALISE LE TABLEAU DES ERREURS //
        $errors = [];

        // SI LE SERVEUR REÇOIT UNE REQUÊTE POST //
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // INITIALISE UNE NOUVELLE SESSION //
            $user = new Users();
            $username = cleanInput($_POST['username']);
            $email = cleanInput($_POST['email']);
            $password = cleanInput($_POST['password']);

            // VALIDATION DU NOM D'UTILISATEUR //
            if (empty($username)) {
                $errors['username'] = $messageManager->getMessage('error', 'username_required');
            } elseif (!preg_match($regexManager->getRegex('username'), $username)) {
                $errors['username'] = $messageManager->getMessage('error', 'invalid_username_format');
            }

            // VALIDATION DE L'EMAIL //
            if (empty($email)) {
                $errors['email'] = $messageManager->getMessage('error', 'email_required');
            } elseif (!preg_match($regexManager->getRegex('email'), $email)) {
                $errors['email'] = $messageManager->getMessage('error', 'invalid_email_format');
            }

            // VALIDATION DU MOT DE PASSE //
            if (!empty($password) && !preg_match($regexManager->getRegex('password'), $password)) {
                $errors['password'] = $messageManager->getMessage('error', 'invalid_password_format');
            }

            // S'IL N'Y A PAS D'ERREURS, ON CONTINUE //
            if (empty($errors)) {
                // RESTE DU CODE ...
            }
        }

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
