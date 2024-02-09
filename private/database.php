<?php

class DatabaseConnection
{
    private $pdo;

    /** CONSTRUCTEUR : INITIALISE UNE CONNEXION À LA BASE DE DONNÉES */
    public function __construct()
    {
        try {
            // TENTE DE SE CONNECTER À LA BASE DE DONNÉES EN UTILISANT PDO //
            $this->pdo = new PDO('mysql:host=localhost;dbname=francesurvival;charset=utf8', 'root', '');
        } catch (PDOException $e) {
            // REDIRIGE SUR LA RACINE DU SITE SI LA CONNECTION A LA BASE ÉCHOUE //
            header('Location: /DB-error');
        }
    }

    /** MÉTHODE POUR RÉCUPÉRER L'OBJET PDO DE LA CONNEXION À LA BASE DE DONNÉES */
    // UTILISÉE POUR ACCÉDER À LA BASE DE DONNÉES DEPUIS D'AUTRES PARTIES DU SITE //
    public function getDatabase()
    {
        return $this->pdo;
    }


    // DESTRUCTEUR : FERME LA CONNEXION À LA BASE DE DONNÉES //
    public function __destruct()
    {
        $this->pdo = null;
    }
}
