<?php

require_once '../models/user.php';
require_once '../private/database.php';
require_once '../utils/clean-input.php';
require_once '../utils/messages-manager.php';
require_once '../utils/regex-manager.php';

class UserController
{

    // LOGIQUE POUR ENREGISTRER L'UTILISATEUR DANS LA BASE DE DONNÉES & GÉRER LES ERREURS //
    public function registration()
    {
        // ON INSTANCIE LES MANAGERS POUR LES MESSAGES ET LES REGEX //
        $messageManager = new MessageManager();
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

            // VALIDATION DU NOM D'UTILISATEUR //
            $user->setUsername($username);
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


            // VALIDATION DE L'EMAIL //
            $user->setEmail($email);
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
        require_once "../views/elements/footer.php";
    }





    // LOGIQUE POUR CONNECTER L'UTILISATEUR //
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



    // LOGIQUE POUR AFFICHER LA PAGE DE PROFIL DE L'UTILISATEUR //
    public function profile()
    {
        // INSTANTIATION DE LA CLASSE MessageManager POUR GERER LES MESSAGES //
        $messageManager = new MessageManager();
        $regexManager = new RegexManager();

        // ON INITIALISE LE TABLEAU DES ERREURS //
        $errors = [];

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
                //$user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setTribe($tribe);
                $user->setPhone($phone);
                $user->setDescription($description);
                //$user->setAvatar($avatar);
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
        // SI ON A DES ERREURS, ON LES AFFICHE //
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        }

        // ON AFFICHE LA VUE DE LA PAGE DE PROFIL //
        require_once '../views/elements/header.php';
        require_once '../views/pages/account/profile.php';
        require_once "../views/elements/footer.php";
    }



    // LOGIQUE POUR SE DÉCONNECTER DU SITE //
    public function logout()
    {
        // ON INSTANCIE LES CLASSES MessageManager POUR GERER LES MESSAGES //
        $messageManager = new MessageManager();

        // NETTOIE TOUTES LES DONNÉES DE LA SESSION //
        $_SESSION = [];

        // DETRUIT LA SESSION //
        session_destroy();

        // REDEMARRE LA SESSION POUR STOCKER LE MESSAGE DE SUCCÈS //
        session_start();

        // MESSAGE DE SUCCÈS SI L'UTILISATEUR EST DÉCONNECTÉ //
        $_SESSION['success'] = $messageManager->getMessage('success', 'logged_out');

        // REDIRECTION VERS LA PAGE D'ACCUEIL //
        header('Location: /');
        // FIN DE L'EXECUTION DU SCRIPT //
        exit;
    }
}