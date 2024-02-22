<?php

require_once '../private/database.php';
require_once '../utils/messages-manager.php';

class Article
{
    private $pdo;
    private $title;
    private $content;
    private $cover;
    private $authorAvatar;
    private $id_users;
    private $id_articles_categories;


    /** MÉTHODE POUR INITIALISER LA CONNEXION A LA BASE DE DONNÉES */
    public function __construct()
    {
        $database = new DatabaseConnection;
        $this->pdo = $database->getDatabase();
    }

    /** MÉTHODE POUR GÉRER LES ERREURS DE LA BASE DE DONNÉES POUR PAS REECRIRE LE CODE À CHAQUE FOIS */
    private function handleDatabaseError()
    {
        // ON INSTANCIE MESSAGE MANAGER POUR AFFICHER LES MESSAGES D'ERREURS //
        $messageManager = new MessageManager();

        // AFFICHE L'ERREUR EN CAS D'ÉCHEC ET REDIRIGE VERS LA PAGE D'ACCUEIL //
        $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
        header('Location: /');
    }

    /** MÉTHODE POUR CRÉER UN ARTICLE */
    public function create()
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
            return $req->execute();
        } catch (PDOException $e) {
            $this->handleDatabaseError();
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
            $this->handleDatabaseError();
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** MÉTHODE POUR VÉRIFIER SI UNE CATÉGORIE EXISTE */
    public function checkCategoryExistById()
    {
        $sql = 'SELECT COUNT(*) FROM `gt3f5b_articles_categories` WHERE `id` = :id';
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':id', $this->id_articles_categories, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_COLUMN);
    }

    /** MÉTHODE POUR RÉCUPÉRER LES ARTICLES PAR CATÉGORIE */
    public function getArticlesByCategory()
    {
        try {
            // PREPARATION DE LA REQUETE //
            $sql = 'SELECT `gt3f5b_articles`.`id`, `title`, SUBSTR(`content`, 1, 100) AS `content`, `views`, `cover`, DATE_FORMAT(`date`, "le %d/%m/%Y à %Hh%i") AS published_date_fr, `id_users`, `name`, `gt3f5b_users`.`username` AS author, `gt3f5b_users`.`avatar` AS authorAvatar FROM `gt3f5b_articles`
            INNER JOIN `gt3f5b_articles_categories` ON `id_articles_categories` = `gt3f5b_articles_categories`.`id`
            INNER JOIN `gt3f5b_users` ON `gt3f5b_articles`.`id_users` = `gt3f5b_users`.`id`
            WHERE `id_articles_categories` = :category';
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':category', $this->id_articles_categories, PDO::PARAM_INT);
            $req->execute();

            // FETCH ALL RETOURNE UN TABLEAU CONTENANT TOUTES LES LIGNES DE LA TABLE //
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $this->handleDatabaseError();
            // ON ARRÊTE L'EXÉCUTION DU SCRIPT //
            exit();
        }
    }

    /** MÉTHODE POUR SETTER LA CATEGORIE PAR SON NOM */
    public function setCategoryByName($categoryName)
    {
        $sql = 'SELECT `id` FROM `gt3f5b_articles_categories` WHERE `name` = :name';
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':name', $categoryName, PDO::PARAM_STR);
        $req->execute();
        $this->id_articles_categories = $req->fetch(PDO::FETCH_COLUMN);
    }

    /** SETTER POUR ARTICLE TITLE */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /** SETTER POUR ARTICLE CONTENT */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /** SETTER POUR ARTICLE COVER */
    public function setArticleCover(string $coverFileName)
    {
        $this->cover = $coverFileName;
    }

    /** SETTER POUR ARTICLE ID USERS */
    public function setAuthor($userId)
    {
        $this->id_users = $userId;
    }

    /** SETTER POUR ARTICLE ID ARTICLES CATEGORIES */
    public function setCategory($category)
    {
        $this->id_articles_categories = $category;
    }


    /** SETTER POUR L'AVATAR DE L'AUTEUR */
    public function setAuthorAvatar($authorAvatar)
    {
        $this->authorAvatar = $authorAvatar;
    }
}