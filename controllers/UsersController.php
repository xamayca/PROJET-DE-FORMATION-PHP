<?php
require_once '../models/user.php';
require_once '../private/database.php';
require_once '../utils/clean-input.php';
require_once '../utils/alerts-manager.php';
require_once '../utils/regex-manager.php';

class UsersController
{

    /** LOGIQUE POUR ENREGISTRER L'UTILISATEUR DANS LA BASE DE DONNÉES & GÉRER LES ERREURS */
    public function registration()
    {
        var_dump("registration called");
        var_dump($_POST);
        $AlertsManager = new AlertsManager();
        $RegexManager = new RegexManager();
        $errors = [];

        $user = new Users();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // NETTOYAGE DES DONNÉES REÇUES
            foreach ($_POST as $key => $value) {
                $$key = cleanInput($value);
            }
            var_dump($_POST);
            $user->setUsername($username);
            // VALIDATION DU NOM D'UTILISATEUR
            if (empty($username)) {
                $errors['username'] = $AlertsManager->getErrorMessages('username', 'required');
            } elseif (!preg_match($RegexManager->getRegex('username'), $username)) {
                $errors['username'] = $AlertsManager->getErrorMessages('username', 'invalid');
            } elseif ($user->checkUsernameAlreadyUse($username)) {
                $errors['username'] = $AlertsManager->getErrorMessages('username', 'exists');
            }

            $user->setEmail($email);
            // VALIDATION DE L'EMAIL
            if (empty($email)) {
                $errors['email'] = $AlertsManager->getErrorMessages('email', 'required');
            } elseif (!preg_match($RegexManager->getRegex('email'), $email)) {
                $errors['email'] = $AlertsManager->getErrorMessages('email', 'invalid');
            } elseif ($user->checkEmailAlreadyUse($email)) {
                $errors['email'] = $AlertsManager->getErrorMessages('email', 'exists');
            }

            // VALIDATION DU MOT DE PASSE
            if (empty($password)) {
                $errors['password'] = $AlertsManager->getErrorMessages('password', 'required');
            } elseif (!preg_match($RegexManager->getRegex('password'), $password)) {
                $errors['password'] = $AlertsManager->getErrorMessages('password', 'invalid');
            }

            // VALIDATION DE LA CONFIRMATION DU MOT DE PASSE
            if (empty($password_confirm)) {
                $errors['passwordConfirm'] = $AlertsManager->getErrorMessages('password_confirm', 'required');
            } elseif ($password !== $password_confirm) {
                $errors['passwordConfirm'] = $AlertsManager->getErrorMessages('password_confirm', 'invalid');
            }

            // VALIDATION DE LA DATE DE NAISSANCE
            if (!empty($birthdate) && !preg_match($RegexManager->getRegex('date'), $birthdate)) {
                $errors['birthdate'] = $AlertsManager->getErrorMessages('birthdate', 'invalid');
            }

            // ENREGISTREMENT DE L'UTILISATEUR DANS LA BASE DE DONNÉES
            if (empty($errors)) {
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setBirthdate($birthdate);

                $result = $user->create();

                if ($result) {
                    $_SESSION['success'] = $AlertsManager->getSuccessMessages('account', 'registration');
                } else {
                    $errors['global'] = $AlertsManager->getErrorMessages('other', 'global');
                }
            }
        }
        var_dump($errors);
        require_once '../views/pages/account/registration.php';
    }

    /** LOGIQUE POUR CONNECTER L'UTILISATEUR & GÉRER LES ERREURS */
    public function login()
    {
        $AlertsManager = new AlertsManager();
        $errors = [];

        $user = new Users();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = cleanInput($_POST['email'] ?? '');
            $password = cleanInput($_POST['password'] ?? '');

            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user->setEmail($email);
                $userPassword = $user->getPassword();
                $userInfo = $user->getUserByEmail();

                if ($userInfo) {
                    if (password_verify($password, $userPassword)) {
                        if (isset($_POST['remember'])) {
                            setcookie('email', $userInfo['email'], time() + 60, '/');
                            $_SESSION['user'] = $userInfo;
                            header('Location: /');
                            exit;
                        }
                    } else {
                        $errors['other'] = $AlertsManager->getErrorMessages('other', 'login');
                    }
                } else {
                    $errors['email'] = $AlertsManager->getErrorMessages('email', 'invalid');
                }
            } else {
                $errors['email'] = $AlertsManager->getErrorMessages('email', 'required');
            }

            if (empty($password)) {
                $errors['password'] = $AlertsManager->getErrorMessages('password', 'required');
            }
        }
        require_once '../views/pages/account/login.php';
    }
}
