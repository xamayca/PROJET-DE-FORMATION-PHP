<?php

require_once '../private/database.php';
require_once '../utils/messages-manager.php';

class Article
{
    private $pdo;
    private $id;
    private $title;
    private $content;
    private $views;
    private $cover;
    private $date;
    private $id_users;
    private $id_articles_categories;




    /** MÉTHODE POUR INITIALISER LA CONNEXION A LA BASE DE DONNÉES */
    public function __construct()
    {
        $database = new DatabaseConnection;
        $this->pdo = $database->getDatabase();
    }

    /** MÉTHODE POUR GÉRER LES ERREURS DE LA BASE DE DONNÉES POUR PAS REECRIRE LE CODE À CHAQUE FOIS */
    private function handleDatabaseError(PDOException $e)
    {
        // ON INSTANCIE MESSAGE MANAGER POUR AFFICHER LES MESSAGES D'ERREURS //
        $messageManager = new MessageManager();

        // AFFICHE L'ERREUR EN CAS D'ÉCHEC ET REDIRIGE VERS LA PAGE D'ACCUEIL //
        $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
        header('Location: /');
    }

    /** MÉTHODE POUR CRÉER UN ARTICLE */
    public function create($userId)
    {
        try {
            // PRÉPARE LA REQUETE //
            $sql = "INSERT INTO `gt3f5b_articles` (title, content, cover, id_users, id_articles_categories, date) 
            VALUES (:title, :content, :cover, :id_users, :id_articles_categories, NOW())";
            $req = $this->pdo->prepare($sql);

            // LIE LES VALEURS AUX PARAMÈTRES DE LA REQUETE //
            $req->bindValue(':title', $this->title, PDO::PARAM_STR);
            $req->bindValue(':content', $this->content, PDO::PARAM_STR);
            $req->bindValue(':cover', $this->cover, PDO::PARAM_STR);
            $req->bindValue(':id_users', $this->id_users, PDO::PARAM_INT); // Utilisation de l'ID de l'utilisateur fourni en paramètre
            $req->bindValue(':id_articles_categories', $this->id_articles_categories, PDO::PARAM_INT);

            // EXECUTE LA REQUETE //
            $req->execute();
        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** MÉTHODE POUR RÉCUPÉRER LA LISTE DES CATÉGORIES D'ARTICLES */
    public function getCategoriesList()
    {
        try {
            // PRÉPARE LA REQUETE //
            $sql = 'SELECT `id`,`name` FROM `gt3f5b_articles_categories`';
            $req = $this->pdo->query($sql);

            // FETCH ALL RETOURNE UN TABLEAU CONTENANT TOUTES LES LIGNES DE LA TABLE //
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** MÉTHODE POUR VÉRIFIER SI UNE CATÉGORIE EXISTE */
    public function checkCategoryExistById()
    {
        $sql = 'SELECT COUNT(*) FROM `gt3f5b_articles_categories` WHERE `id` = :id';
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':id', $this->id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_COLUMN);
    }


    /** SETTER POUR ARTICLE ID */
    public function setId($id)
    {
        $this->id = $id;
    }

    /** GETTER POUR ARTICLE ID */
    public function getId()
    {
        return $this->id;
    }

    /** SETTER POUR ARTICLE TITLE */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /** GETTER POUR ARTICLE TITLE */
    public function getTitle()
    {
        return $this->title;
    }

    /** SETTER POUR ARTICLE CONTENT */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /** GETTER POUR ARTICLE CONTENT */
    public function getContent()
    {
        return $this->content;
    }

    /** SETTER POUR ARTICLE VIEWS */
    public function setViews($views)
    {
        $this->views = $views;
    }

    /** GETTER POUR ARTICLE VIEWS */
    public function getViews()
    {
        return $this->views;
    }

    /** SETTER POUR ARTICLE COVER */
    public function setArticleCover(string $coverFileName)
    {
        $this->cover = $coverFileName;
    }

    /** GETTER POUR ARTICLE COVER */
    public function getCover()
    {
        return $this->cover;
    }

    /** SETTER POUR ARTICLE DATE */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /** GETTER POUR ARTICLE DATE */
    public function getDate()
    {
        return $this->date;
    }

    /** SETTER POUR ARTICLE ID USERS */
    public function setAuthor($userId)
    {
        $this->id_users = $userId;
    }

    /** GETTER POUR ARTICLE ID USERS */
    public function getAuthor()
    {
        return $this->id_users;
    }

    /** SETTER POUR ARTICLE ID ARTICLES CATEGORIES */
    public function setCategory($category)
    {
        $this->id_articles_categories = $category;
    }

    /** GETTER POUR ARTICLE ID ARTICLES CATEGORIES */
    public function getCategory()
    {
        return $this->id_articles_categories;
    }

}