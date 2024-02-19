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
                $user_password = $user->getUserPassword();

                // SI LE MOT DE PASSE CORRESPOND, ON CONNECTE L'UTILISATEUR //
                if (isset($user_password) && password_verify($password, $user_password)) {
                    $userData = $user->getUserByEmail();
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


            // VALIDATION DU NOM D'UTILISATEUR //
            if (isset($_POST['update_username'])) {
                $username = cleanInput($_POST['update_username']);
                $user->setUsername($username);
                if (!preg_match($regexManager->getRegex('username'), $username)) {
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'username_invalid');
                } elseif ($user->checkUsernameAlreadyUse()) {
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'username_exists');
                } elseif (strlen($username) < 3) {
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'username_minlength');
                } elseif (strlen($username) > 30) {
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'username_maxlength');
                }
                // SI AUCUNE ERREUR N'A ÉTÉ TROUVÉE, PROCÉDEZ À LA MISE À JOUR DU PROFIL //
                if (empty($_SESSION['warning'])) {
                    // APPEL DE LA MÉTHODE updateUsername() POUR METTRE À JOUR LE NOM D'UTILISATEUR //
                    $result = $user->updateUsername();
                    // SI LA MISE A JOUR A RÉUSSIE //
                    if ($result) {
                        $_SESSION['user']['username'] = $username;
                        // REDIRIGE VERS LA PAGE DE PROFIL AVEC UN MESSAGE DE SUCCÈS //
                        $_SESSION['success'] = $messageManager->getMessage('success', 'username_updated');
                    } else {
                        // SI L'ENREGISTREMENT A ÉCHOUÉ, AFFICHE UN MESSAGE D'ERREUR ET REDIRIGE VERS LA PAGE PROFIL //
                        $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
                    }
                }
            }



            // VALIDATION DE L'EMAIL //
            if (isset($_POST['update_email'])) {
                $email = cleanInput($_POST['update_email']);
                $user->setEmail($email);
                if (!preg_match($regexManager->getRegex('email'), $email)) {
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'email_invalid');
                } elseif ($user->checkEmailAlreadyUse()) {
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'email_exists');
                }
                // SI AUCUNE ERREUR N'A ÉTÉ TROUVÉE, PROCÉDEZ À LA MISE À JOUR DU PROFIL //
                if (empty($_SESSION['warning'])) {
                    // APPEL DE LA MÉTHODE updateUsername() POUR METTRE À JOUR LE NOM D'UTILISATEUR //
                    $result = $user->updateEmail();
                    // SI LA MISE A JOUR A RÉUSSIE //
                    if ($result) {
                        // REDIRIGE VERS LA PAGE DE PROFIL AVEC UN MESSAGE DE SUCCÈS //
                        $_SESSION['success'] = $messageManager->getMessage('success', 'email_updated');
                    } else {
                        // SI L'ENREGISTREMENT A ÉCHOUÉ, AFFICHE UN MESSAGE D'ERREUR ET REDIRIGE VERS LA PAGE PROFIL //
                        $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
                    }
                }
            }


            // VALIDATION DU NUMÉRO DE TÉLÉPHONE //
            if (isset($_POST['update_phone'])) {
                $phone = cleanInput($_POST['update_phone']);
                $user->setPhone($phone);
                if (!preg_match($regexManager->getRegex('phone'), $phone)) {
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'phone_invalid');
                }
                // SI AUCUNE ERREUR N'A ÉTÉ TROUVÉE, PROCÉDEZ À LA MISE À JOUR DU PROFIL //
                if (empty($errors)) {
                    // APPEL DE LA MÉTHODE updateUsername() POUR METTRE À JOUR LE NOM D'UTILISATEUR //
                    $result = $user->updatePhone();
                    // SI LA MISE A JOUR A RÉUSSIE //
                    if ($result) {
                        // REDIRIGE VERS LA PAGE DE PROFIL AVEC UN MESSAGE DE SUCCÈS //
                        $_SESSION['success'] = $messageManager->getMessage('success', 'phone_updated');
                    } else {
                        // SI L'ENREGISTREMENT A ÉCHOUÉ, AFFICHE UN MESSAGE D'ERREUR ET REDIRIGE VERS LA PAGE PROFIL //
                        $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
                    }
                }
            }


            // VALIDATION DE LA TRIBU //
            if (isset($_POST['update_tribe'])) {
                $tribe = cleanInput($_POST['update_tribe']);
                $user->setTribe($tribe);
                if (strlen($tribe) > 25) {
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'tribe_maxlength');
                }
                // SI AUCUNE ERREUR N'A ÉTÉ TROUVÉE, PROCÉDEZ À LA MISE À JOUR DU PROFIL //
                if (empty($errors)) {
                    // APPEL DE LA MÉTHODE updateUsername() POUR METTRE À JOUR LE NOM D'UTILISATEUR //
                    $result = $user->updateTribe();
                    // SI LA MISE A JOUR A RÉUSSIE //
                    if ($result) {
                        // REDIRIGE VERS LA PAGE DE PROFIL AVEC UN MESSAGE DE SUCCÈS //
                        $_SESSION['success'] = $messageManager->getMessage('success', 'tribe_updated');
                    } else {
                        // SI L'ENREGISTREMENT A ÉCHOUÉ, AFFICHE UN MESSAGE D'ERREUR ET REDIRIGE VERS LA PAGE PROFIL //
                        $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
                    }
                }
            }
            // VALIDATION DE LA DESCRIPTION //
            if (isset($_POST['update_description'])) {
                $description = cleanInput($_POST['update_description']);
                $user->setDescription($description);
                if (strlen($description) > 150) {
                    $errors = $_SESSION['warning'] = $messageManager->getMessage('error', 'description_maxlength');
                }
                // SI AUCUNE ERREUR N'A ÉTÉ TROUVÉE, PROCÉDEZ À LA MISE À JOUR DU PROFIL //
                if (empty($errors)) {
                    // APPEL DE LA MÉTHODE updateUsername() POUR METTRE À JOUR LE NOM D'UTILISATEUR //
                    $result = $user->updateDescription();
                    // SI LA MISE A JOUR A RÉUSSIE //
                    if ($result) {
                        // REDIRIGE VERS LA PAGE DE PROFIL AVEC UN MESSAGE DE SUCCÈS //
                        $_SESSION['success'] = $messageManager->getMessage('success', 'description_updated');
                    } else {
                        // SI L'ENREGISTREMENT A ÉCHOUÉ, AFFICHE UN MESSAGE D'ERREUR ET REDIRIGE VERS LA PAGE PROFIL //
                        $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
                    }
                }
            }


            // VALIDATION DE LA SIGNATURE //
            if (isset($_POST['update_signature'])) {
                $signature = cleanInput($_POST['update_signature']);
                $user->setSignature($signature);
                if (strlen($signature) > 50) {
                    $errors = $_SESSION['warning'] = $messageManager->getMessage('error', 'signature_maxlength');
                }

                // SI AUCUNE ERREUR N'A ÉTÉ TROUVÉE, PROCÉDEZ À LA MISE À JOUR DU PROFIL //
                if (empty($errors)) {
                    // APPEL DE LA MÉTHODE updateUsername() POUR METTRE À JOUR LE NOM D'UTILISATEUR //
                    $result = $user->updateSignature();
                    // SI LA MISE A JOUR A RÉUSSIE //
                    if ($result) {
                        // REDIRIGE VERS LA PAGE DE PROFIL AVEC UN MESSAGE DE SUCCÈS //
                        $_SESSION['success'] = $messageManager->getMessage('success', 'signature_updated');
                    } else {
                        // SI L'ENREGISTREMENT A ÉCHOUÉ, AFFICHE UN MESSAGE D'ERREUR ET REDIRIGE VERS LA PAGE PROFIL //
                        $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
                    }
                }
            }

        // VALIDATION DES MOTS DE PASSE //
        if (isset($_POST['modify_password'])) {
            $current_password = cleanInput($_POST['current_password']);
            $new_password = cleanInput($_POST['new_password']);
            $confirm_password = cleanInput($_POST['password_confirm']);

            // RÉCUPÉRATION DES DONNÉES DE L'UTILISATEUR //
            $user->setId($_SESSION['user']['id']);
            $userData = $user->getUserById();

            // RÉCUPÉRATION DU MOT DE PASSE DE L'UTILISATEUR //
            $user->setEmail($userData['email']);
            $user_password = $user->getUserPassword();

            // VALIDATION DU MOT DE PASSE ACTUEL //
            if (empty($current_password)) {
                $errors['current_password'] = $messageManager->getMessage('error', 'password_required');
            } elseif (!password_verify($current_password, $user_password)) {
                $errors['current_password'] = $messageManager->getMessage('error', 'password_invalid');
            }

            // VALIDATION DU NOUVEAU MOT DE PASSE //
            if (empty($new_password)) {
                $errors['new_password'] = $messageManager->getMessage('error', 'new_password_required');
            } elseif (!preg_match($regexManager->getRegex('password'), $new_password)) {
                $errors['new_password'] = $messageManager->getMessage('error', 'new_password_invalid');
            } elseif (strlen($new_password) < 8) {
                $errors['new_password'] = $messageManager->getMessage('error', 'password_minlength');
            }

            // VALIDATION DE LA CONFIRMATION DU MOT DE PASSE //
            if (empty($confirm_password)) {
                $errors['password_confirm'] = $messageManager->getMessage('error', 'password_confirm_required');
            } elseif ($new_password !== $confirm_password) {
                $errors['password_confirm'] = $messageManager->getMessage('error', 'password_confirm_invalid');
            }

            // SI AUCUNE ERREUR N'A ÉTÉ TROUVÉE, PROCÉDEZ À LA MISE À JOUR DU MOT DE PASSE //
            if (empty($errors)) {
                // ON HASHE LE MOT DE PASSE AVANT DE L'ENREGISTRER DANS LA BASE DE DONNÉES //
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                // ON SET LE MOT DE PASSE HASHE DANS L'OBJET USER //
                $user->setPassword($hashed_password);
                // ICI ON MET À JOUR LE MOT DE PASSE DE L'UTILISATEUR //
                $result = $user->updateUserPassword($_SESSION['user']['id'], $hashed_password);
                if ($result) {
                    // REDIRIGE VERS LA PAGE DE PROFIL AVEC UN MESSAGE DE SUCCÈS //
                    $_SESSION['success'] = $messageManager->getMessage('success', 'password_updated');
                } else {
                    // SI L'ENREGISTREMENT A ÉCHOUÉ, AFFICHE UN MESSAGE D'ERREUR ET REDIRIGE VERS LA PAGE PROFIL //
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
                }
            }
        }


        // SUPPRESSION DU COMPTE DE L'UTILISATEUR (APPEL DE LA MÉTHODE deleteAccount()) //
        if(isset($_POST['delete_account'])) {
            $this->deleteAccount();
        }


        $userData = $user->getUserById();
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


// LOGIQUE POUR SUPPRIMER LE COMPTE DE L'UTILISATEUR //
    public function deleteAccount()
    {
        // ON INSTANCIE LA CLASSE Users POUR UTILISER LES MÉTHODES DE LA CLASSE //
        $user = new Users();

        // ON RÉCUPÈRE L'ID DE L'UTILISATEUR CONNECTÉ //
        $messageManager = new MessageManager();
        if(isset($_POST['delete_account'])) {
            $user->setId($_SESSION['user']['id']);
            if ($user->delete()) {
                // ON STOCKE LE MESSAGE DE SUCCÈS DANS UNE VARIABLE POUR L'AFFICHER PLUS TARD //
                $successMessage = $messageManager->getMessage('success', 'account_deleted');
                // ON DETRUIT LA SESSION //
                unset ($_SESSION);
                session_destroy();
                // ON REDEMARRE LA SESSION POUR STOCKER LE MESSAGE DE SUCCÈS //
                session_start();
                // ON RENVOIS L'UTILISATEUR VERS LA PAGE D'ACCUEIL AVEC UN MESSAGE DE SUCCÈS //
                $_SESSION['success'] = $successMessage;
                header('Location: /');
                exit;
            } else {
                $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
            }
        }
    }

}


