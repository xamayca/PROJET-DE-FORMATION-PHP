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
        $messageManager = new MessageManager();
        $regexManager = new RegexManager();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // INITIALISE UNE NOUVELLE SESSION //
            $user = new Users();
            $email = cleanInput($_POST['email']);
            $password = cleanInput($_POST['password']);

            // SI L'EMAIL EST VIDE OU INVALIDE, ON GERE L'ERREUR //
            if (empty($email)) {
                $errors['email'] = $messageManager->getMessage( 'error', 'email_required');
            }

            // SI LE MOT DE PASSE EST VIDE, ON GERE L'ERREUR //
            if (empty($password)) {
                $errors['password'] = $messageManager->getMessage('error', 'password_required');
            }

            // S'IL N'Y A PAS D'ERREURS, ON CONTINUE //
            if (empty($errors)) {
                $user->setEmail($email);
                $userData = $user->getUserByEmail();

                // ON VERIFIE SI LE MOT DE PASSE EST CORRECT ET ON L'AJOUTE DANS LA SESSION //
                if ($userData && password_verify($password, $userData['password'])) {

                    // ON STOCKE LES INFOS DE L'UTILISATEUR DANS LA SESSION //
                    $_SESSION['user'] = [
                        'id' => $userData['id'],
                        'username' => $userData['username'],
                        'email' => $userData['email'],
                    ];

                    // SI LA CONNEXION EST REUSSIE, ON REDIRIGE VERS LA PAGE D'ACCUEIL //
                    $_SESSION['success'] = $messageManager->getMessage( 'success', 'logged_in');
                    header('Location: /');
                    exit;
                } else {
                    $errors['login'] = $messageManager->getMessage('error', 'invalid_credentials');
                }
            }
        }
        require_once '../views/elements/header.php';
        require_once '../views/pages/account/login.php';
        require_once "../views/elements/footer.php";
    }
}