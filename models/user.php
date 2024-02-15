<?php

require_once '../private/database.php';
require_once '../utils/messages-manager.php';

class Users
{
    private $pdo;
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $birthdate;
    private string $tribe;
    private string $phone;
    private string $description;
    private string $avatar;
    private string $signature;
    private string $registerDate;
    private int $id_roles;

    /** CONSTRUCTEUR POUR INITIALISER LA CONNEXION A LA BASE DE DONNÉES */
    public function __construct()
    {
        $database = new DatabaseConnection;
        $this->pdo = $database->getDatabase();
    }

    /** FONCTION POUR GÉRER LES ERREURS DE LA BASE DE DONNÉES POUR PAS REECRIRE LE CODE À CHAQUE FOIS */
    private function handleDatabaseError(PDOException $e)
    {
        // ON INSTANCIE MESSAGE MANAGER POUR AFFICHER LES MESSAGES D'ERREURS //
        $messageManager = new MessageManager();

        // AFFICHE L'ERREUR EN CAS D'ÉCHEC ET REDIRIGE VERS LA PAGE D'ACCUEIL //
        $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
        header('Location: /');
    }


    /** MÉTHODE CREATE POUR ENREGISTRER L'UTILISATEUR DANS LA BASE DE DONNÉES */
    public function create()
    {
        try {
            // PRÉPARE UNE REQUÊTE SQL POUR INSÉRER LES INFORMATIONS DE L'UTILISATEUR //
            $req = $this->pdo->prepare("INSERT INTO `gt3f5b_users` (username, email, password, birthdate, registerDate, id_roles)
            VALUES (:username, :email, :password, :birthdate, NOW(), 1 )");

            // LIE LES VALEURS AUX PARAMÈTRES DE LA REQUÊTE //
            $req->bindValue(':username', $this->username, PDO::PARAM_STR);
            $req->bindValue(':email', $this->email, PDO::PARAM_STR);
            $req->bindValue(':password', $this->password, PDO::PARAM_STR);
            $req->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);

            // EXÉCUTE LA REQUÊTE //
            return $req->execute();

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** MÉTHODE POUR METTRE A JOUR LE NOM D'UTILISATEUR */
    public function updateUsername()
    {
        try {
            $sql = 'UPDATE `gt3f5b_users` SET `username` = :username WHERE `id` = :id';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':username', $this->username, PDO::PARAM_STR);
            $req->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $req->execute();

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** MÉTHODE POUR METTRE A JOUR L'EMAIL DE L'UTILISATEUR */
    public function updateEmail()
    {
        try {
            $sql = 'UPDATE `gt3f5b_users` SET `email` = :email WHERE `id` = :id';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':email', $this->email, PDO::PARAM_STR);
            $req->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $req->execute();

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** MÉTHODE POUR METTRE A JOUR LE MOT DE PASSE DE L'UTILISATEUR */
    public function updatePhone()
    {
        try {
            $sql = 'UPDATE `gt3f5b_users` SET `phone` = :phone WHERE `id` = :id';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':phone', $this->phone, PDO::PARAM_STR);
            $req->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $req->execute();

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** MÉTHODE POUR METTRE A JOUR LA DESCRIPTION DE L'UTILISATEUR */
    public function updateDescription()
    {
        try {
            $sql = 'UPDATE `gt3f5b_users` SET `description` = :description WHERE `id` = :id';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':description', $this->description, PDO::PARAM_STR);
            $req->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $req->execute();

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** MÉTHODE POUR METTRE A JOUR L'AVATAR DE L'UTILISATEUR */
    public function updateSignature()
    {
        try {
            $sql = 'UPDATE `gt3f5b_users
            ` SET `signature` = :signature WHERE `id` = :id';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':signature', $this->signature, PDO::PARAM_STR);
            $req->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $req->execute();

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** MÉTHODE POUR METTRE A JOUR LA TRIBU DE L'UTILISATEUR */
    public function updateTribe()
    {
        try {
            $sql = 'UPDATE `gt3f5b_users` SET `tribe` = :tribe WHERE `id` = :id';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':tribe', $this->tribe, PDO::PARAM_STR);
            $req->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $req->execute();

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** REQUÊTE POUR SUPPRIMER UN UTILISATEUR DE LA BASE DE DONNÉES */
    public function delete()
    {
        try {
            $sql = 'DELETE FROM `gt3f5b_users` WHERE `id` = :id';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $req->execute();

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** REQUÊTE POUR VERIFIER SI UN USERNAME EXISTE DANS LA BASE DE DONNÉES */
    public function checkUsernameAlreadyUse()
    {
        try {
            $sql = 'SELECT COUNT(`username`) FROM `gt3f5b_users` WHERE `username` = :username';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':username', $this->username, PDO::PARAM_STR);
            $req->execute();
            return $req->fetch(PDO::FETCH_COLUMN);

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** REQUÊTE POUR VERIFIER SI UN EMAIL EXISTE DANS LA BASE DE DONNÉES */
    public function checkEmailAlreadyUse()
    {
        try {
            $sql = 'SELECT COUNT(`email`) FROM `gt3f5b_users` WHERE `email` = :email';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':email', $this->email, PDO::PARAM_STR);
            $req->execute();
            return $req->fetch(PDO::FETCH_COLUMN);

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** REQUÊTE POUR RÉCUPÉRER LES INFORMATIONS DE L'UTILISATEUR PAR SON EMAIL (id, username, email, password, id roles) */
    public function getUserByEmail()
    {
        try {
            $sql = 'SELECT `id`, `username`, `email`, `id_roles` FROM `gt3f5b_users` WHERE `email` = :email';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':email', $this->email, PDO::PARAM_STR);
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            exit();
        }
    }

    /** REQUÊTE POUR RÉCUPÉRER LE MOT DE PASSE D'UN UTILISATEUR */
    public function getUserPassword()
    {
        try {
            $sql = 'SELECT `password` FROM `gt3f5b_users` WHERE `email` = :email';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':email', $this->email, PDO::PARAM_STR);
            $req->execute();
            return $req->fetch(PDO::FETCH_COLUMN);

        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            exit();
        }
    }

    /** GETTER POUR USER ID */
    public function getUserById()
    {
        try {
            $sql = 'SELECT u.`id`, u.`username`, u.`email`, 
                DATE_FORMAT(u.`birthdate`, "né le %e/%m/%Y") AS birthdate_fr,
                u.`tribe`, u.`phone`, u.`description`, u.`avatar`, u.`signature`, 
                DATE_FORMAT(u.`registerDate`, "le %d/%m/%Y à %Hh%i") AS registerDate_fr,
                r.`name` AS role_name
                FROM `gt3f5b_users` u 
                INNER JOIN `gt3f5b_roles` r ON u.`id_roles` = r.`id` 
                WHERE u.`id` = :id';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':id', $this->id, PDO::PARAM_INT);
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            exit();
        }
    }

    /** SETTER POUR USER ID */
    public function setId($id)
    {
        $this->id = $id;
    }

    /** GETTER POUR USER Username */
    public function getUsername(): string
    {
        return $this->username;
    }

    /** SETTER POUR USER Username */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /** GETTER POUR USER Email */
    public function getEmail(): string
    {
        return $this->email;
    }

    /** SETTER POUR USER Email */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /** SETTER POUR USER Password */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /** GETTER POUR USER Birthdate */
    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    /** SETTER POUR USER Birthdate */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /** GETTER POUR USER Tribe */
    public function getTribe(): string
    {
        return $this->tribe;
    }

    /** SETTER POUR USER Tribe */
    public function setTribe($tribe)
    {
        $this->tribe = $tribe;
    }

    /** GETTER POUR USER Phone */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /** SETTER POUR USER Phone */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /** GETTER POUR USER Description */
    public function getDescription(): string
    {
        return $this->description;
    }

    /** SETTER POUR USER Description */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /** GETTER POUR USER Avatar */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /** SETTER POUR USER Avatar */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /** GETTER POUR USER Signature */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /** SETTER POUR USER Signature */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    /** GETTER POUR USER RegisterDate */
    public function getRegisterDate(): string
    {
        return $this->registerDate;
    }

    /** SETTER POUR USER RegisterDate */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;
    }

    /** GETTER POUR USER id_roles */
    public function getid_roles(): int
    {
        return $this->id_roles;
    }

    /** SETTER POUR USER id_roles */
    public function setid_roles($id_roles)
    {
        $this->id_roles = $id_roles;
    }
}
