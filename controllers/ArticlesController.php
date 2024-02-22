<?php

require_once '../models/article.php';
require_once '../private/database.php';
require_once '../utils/clean-input.php';
require_once '../utils/messages-manager.php';
require_once '../utils/regex-manager.php';
require_once '../utils/validate-image.php';

class ArticlesController
{
    /** MÉTHODE POUR CRÉER UN ARTICLE */
    public function createArticle()
    {
        // INSTANCIATION DE LA CLASSES MessageManager POUR GERER LES MESSAGES //
        $messageManager = new MessageManager();
        // INSTANCIATION DE LA CLASSE RegexManager POUR UTILISER LES EXPRESSIONS RÉGULIÈRES //
        $regexManager = new RegexManager();
        // INITIALISE UN NOUVEL ARTICLE //
        $article = new Article();
        // ON INITIALISE LE TABLEAU DES ERREURS //
        $errors = [];

        // SI LE SERVEUR REÇOIT UNE REQUÊTE POST //
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // NETTOYAGE DES DONNÉES REÇUES
            foreach ($_POST as $key => $value) {
                $$key = cleanInput($value);
            }

            // VALIDATION DU TITRE DE L'ARTICLE //
            if (!empty($_POST['title'])) {
                $title = $_POST['title'];
                if (!preg_match($regexManager->getRegex('title'), $title)) {
                    $errors['title'] = $messageManager->getMessage('error', 'title_invalid');
                } elseif (strlen($title) < 3) {
                    $errors['title'] = $messageManager->getMessage('error', 'title_minlength');
                } elseif (strlen($title) > 100) {
                    $errors['title'] = $messageManager->getMessage('error', 'title_maxlength');
                }
            } else {
                $errors['title'] = $messageManager->getMessage('error', 'title_required');
            }

            // VALIDATION DU CONTENU DE L'ARTICLE //
            if (!empty($_POST['content'])) {
                $content = $_POST['content'];
                if (preg_match($regexManager->getRegex('content'), $content)) {
                    $errors['content'] = $messageManager->getMessage('error', 'content_invalid');
                } elseif (strlen($content) < 3) {
                    $errors['content'] = $messageManager->getMessage('error', 'content_minlength');
                } elseif (strlen($content) > 500) {
                    $errors['content'] = $messageManager->getMessage('error', 'content_maxlength');
                }
            } else {
                $errors['content'] = $messageManager->getMessage('error', 'content_required');
            }

            // VALIDATION DE LA COUVERTURE DE L'ARTICLE //
            if (isset($_FILES['cover'])) {
                $cover = $_FILES['cover'];
                $result = validateImage($cover, $messageManager);

                if ($result === true) {
                    // GENERATION D'UN NOM UNIQUE POUR L'AVATAR //
                    $coverFileName = uniqid() . '.' . pathinfo($cover['name'], PATHINFO_EXTENSION);
                    // CHEMIN DE STOCKAGE DE LA COUVERTURE DE L'ARTICLE //
                    $coverPath = '../public/assets/img/uploads/covers-articles/' . $coverFileName;
                    // DEPLACEMENT DE LA COUVERTURE DE L'ARTICLE VERS LE DOSSIER DE STOCKAGE //
                    if (move_uploaded_file($cover['tmp_name'], $coverPath)) {
                        $article->setArticleCover($coverFileName);
                    } else {
                        $errors['cover'] = $messageManager->getMessage('error', 'image_move_error');
                    }
                } else {
                    $errors['cover'] = $result;
                }
            } else {
                $errors['cover'] = $messageManager->getMessage('error', 'cover_required');
            }

            // VALIDATION DE LA CATEGORIE DE L'ARTICLE //
            if (isset($_POST['categories'])) {
                $categoryId = $_POST['categories'];
                $article->setCategory($categoryId);
                if ($article->checkCategoryExistById() === 0) {
                    $errors['categories'] = $messageManager->getMessage('error', 'categories_invalid');
                }
            } else {
                $errors['categories'] = $messageManager->getMessage('error', 'categories_required');
            }

            if (empty($errors)) {
                $article->setTitle($title);
                $article->setContent($content);
                $article->setCategory($categoryId);
                $article->setAuthor($_SESSION['user']['id']);
                $article->setAuthorAvatar($_SESSION['user']['avatar']);
                $result = $article->create();
                if ($result) {
                    $_SESSION['success'] = $messageManager->getMessage('success', 'article_created');
                } else {
                    $_SESSION['warning'] = $messageManager->getMessage('error', 'unexpected_error');
                }
            }
        }

        $categories = $article->getCategoriesList();

        require_once '../views/elements/header.php';
        require_once '../views/pages/articles/create.php';
        require_once '../views/elements/footer.php';
    }

    /** MÉTHODE POUR AFFICHER UN ARTICLE PAR SA CATEGORIE *//** MÉTHODE POUR AFFICHER UN ARTICLE PAR SA CATEGORIE */
    public function displayArticlesByCategory($params=[])
    {
        if (isset($params['categoryName'])) {
            $categoryName = $params['categoryName'];

            $messageManager = new MessageManager();

            $article = new Article();

            $categories = $article->getCategoriesList();

            $article->setCategoryByName($categoryName);

            // RECUPERE DES ARTICLES PAR CATEGORIE //
            $articles = $article->getArticlesByCategory();

            // SI PAS D'ARTICLES POUR CETTE CATEGORIE //
            if (empty($articles)) {
                $_SESSION['warning'] = $messageManager->getMessage('error', 'no_article_found');
            }
        }
        require_once '../views/elements/header.php';
        require_once '../views/pages/articles/list.php';
        require_once '../views/elements/footer.php';
    }

    public function displayArticle($params){
        if (isset($params['categoryName']) && isset($params['articleId'])) {
            $categoryName = $params['categoryName'];
            $articleId = $params['articleId'];

            $messageManager = new MessageManager();

            $article = new Article();

            $categories = $article->getCategoriesList();

            $article->setCategoryByName($categoryName);

            // RECUPERE UN ARTICLE PAR SON ID ET SA CATEGORIE //
            $article->setId($articleId);
            $article->setCategoryByName($categoryName);
            $article = $article->getArticleByIdAndCategory();

            // SI PAS D'ARTICLE POUR CETTE CATEGORIE //
            if (empty($article)) {
                $_SESSION['warning'] = $messageManager->getMessage('error', 'no_article_found');
            }
        }
        require_once '../views/elements/header.php';
        require_once '../views/pages/articles/single.php';
        require_once '../views/elements/footer.php';
    }
}