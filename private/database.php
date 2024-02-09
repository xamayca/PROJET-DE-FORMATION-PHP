<?php

require_once '../utils/messages-manager.php';
class DatabaseConnection
{
    private $pdo;

    /** CONSTRUCTEUR : INITIALISE UNE CONNEXION À LA BASE DE DONNÉES */
    public function __construct()
    {
        // INSTANCIATION DE LA CLASSE MessageManager POUR AFFICHER DES MESSAGES D'ERREURS //
        $messageManager = new MessageManager();

        try {
            // TENTE DE SE CONNECTER À LA BASE DE DONNÉES EN UTILISANT PDO //
            $this->pdo = new PDO('mysql:host=localhost;dbname=francesurvival;charset=utf8', 'root', '');

        } catch (PDOException $e) {
            // REDIRIGE SUR LA RACINE DU SITE SI LA CONNECTION A LA BASE ÉCHOUE & ENVOIS UN MESSAGE D'ERREUR //
            header('Location: /');
            // ON AFFICHE UN MESSAGE D'ERREUR SUR LA PAGE D'ACCUEIL GRÂCE À LA SESSION //
            $_SESSION['warning']= $messageManager->getMessage('error', 'unexpected_error');
            // FERME LA CONNEXION À LA BASE DE DONNÉES //
            exit();
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
