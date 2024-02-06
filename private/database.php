<?php

class DatabaseConnection
{
    private $pdo;

    /** CONSTRUCTEUR : INITIALISE UNE CONNEXION À LA BASE DE DONNÉES */
    public function __construct()
    {
        try {
            // TENTE DE SE CONNECTER À LA BASE DE DONNÉES EN UTILISANT PDO //
            $this->pdo = new PDO('mysql:host=192.168.1.47:;dbname=francesurvival;charset=utf8', 'groot', 'root');

            // AFFICHE UN MESSAGE SI LA CONNEXION EST RÉUSSIE //
            echo ('[DATABASE.PHP] EST ACCESSIBLE');
        } catch (PDOException $e) {
            // REDIRIGE SUR LA RACINE DU SITE SI LA CONNECTION A LA BASE ÉCHOUE //
            header('Location: /erreur-database');
        }
    }

    /** MÉTHODE POUR RÉCUPÉRER L'OBJET PDO DE LA CONNEXION À LA BASE DE DONNÉES */
    // UTILISÉE POUR ACCÉDER À LA BASE DE DONNÉES DEPUIS D'AUTRES PARTIES DU SITE //
    public function getDatabase()
    {
        return $this->pdo;
    }
}
