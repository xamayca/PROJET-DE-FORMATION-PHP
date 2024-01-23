<?php

require_once '../private/database.php';

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

    /** CONSTRUCTEUR POUR INITIALISER LA CONNEXION PDO */
    public function __construct()
    {
        $database = new DatabaseConnection;
        $this->pdo = $database->getDatabase();
    }

    /** MÉTHODE SAVE POUR ENREGISTRER L'UTILISATEUR DANS LA BASE DE DONNÉES */
    public function create()
    {
        try {
            // PRÉPARE UNE REQUÊTE SQL POUR INSÉRER LES INFORMATIONS DE L'UTILISATEUR //
            $req = $this->pdo->prepare("INSERT INTO `gt3f5b_users` (username, email, password, birthdate, registerDate, id_roles)
            VALUES (:username, :email, :password, :birthdate, NOW(), 1 )");
            // LIE LES VALEURS AUX PARAMÈTRES DE LA REQUÊTE
            $req->bindValue(':username', $this->username, PDO::PARAM_STR);
            $req->bindValue(':email', $this->email, PDO::PARAM_STR);
            $req->bindValue(':password', $this->password, PDO::PARAM_STR);
            $req->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
            // EXÉCUTE LA REQUÊTE //
            return $req->execute();
        } catch (PDOException $e) {
            // AFFICHE L'ERREUR EN CAS D'ÉCHEC ET REDIRIGE VERS LA PAGE D'ACCUEIL //
            var_dump($e);
            header('Location: /index.php');
        }
    }

    public function checkUsernameAlreadyUse()
    {
        $sql = 'SELECT COUNT(`username`) FROM `gt3f5b_users` WHERE `username` = :username';
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':username', $this->username, PDO::PARAM_STR);
        $req->execute();
        return $req->fetch(PDO::FETCH_COLUMN);
    }

    public function checkEmailAlreadyUse()
    {
        $sql = 'SELECT COUNT(`email`) FROM `gt3f5b_users` WHERE `email` = :email';
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':email', $this->email, PDO::PARAM_STR);
        $req->execute();
        return $req->fetch(PDO::FETCH_COLUMN);
    }

    /** GETTER POUR USER ID */
    public function getId()
    {
        return $this->id;
    }

    /** SETTER POUR USER ID */
    public function setId($id)
    {
        $this->id = $id;
    }

    /** GETTER POUR USER Username */
    public function getUsername()
    {
        return $this->username;
    }

    /** SETTER POUR USER Username */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /** GETTER POUR USER Email */
    public function getEmail()
    {
        return $this->email;
    }

    /** SETTER POUR USER Email */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /** GETTER POUR USER Password */
    public function getPassword()
    {
        return $this->password;
    }

    /** SETTER POUR USER Password */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /** GETTER POUR USER Birthdate */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /** SETTER POUR USER Birthdate */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /** GETTER POUR USER Tribe */
    public function getTribe()
    {
        return $this->tribe;
    }

    /** SETTER POUR USER Tribe */
    public function setTribe($tribe)
    {
        $this->tribe = $tribe;
    }

    /** GETTER POUR USER Phone */
    public function getPhone()
    {
        return $this->phone;
    }

    /** SETTER POUR USER Phone */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /** GETTER POUR USER Description */
    public function getDescription()
    {
        return $this->description;
    }

    /** SETTER POUR USER Description */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /** GETTER POUR USER Avatar */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /** SETTER POUR USER Avatar */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /** GETTER POUR USER Signature */
    public function getSignature()
    {
        return $this->signature;
    }

    /** SETTER POUR USER Signature */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    /** GETTER POUR USER RegisterDate */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /** SETTER POUR USER RegisterDate */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;
    }

    /** GETTER POUR USER id_roles */
    public function getid_roles()
    {
        return $this->id_roles;
    }

    /** SETTER POUR USER id_roles */
    public function setid_roles($id_roles)
    {
        return $this->$id_roles;
    }
}
