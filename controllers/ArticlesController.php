<?php

require_once '../models/article.php';
require_once '../private/database.php';
require_once '../utils/clean-input.php';
require_once '../utils/messages-manager.php';
require_once '../utils/regex-manager.php';
require_once '../utils/validate-image.php';

class ArticlesController
{
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
                if (!preg_match($regexManager->getRegex('content'), $content)) {
                    $errors['content'] = $messageManager->getMessage('error', 'content_invalid');
                } elseif (strlen($content) < 3) {
                    $errors['content'] = $messageManager->getMessage('error', 'content_minlength');
                } elseif (strlen($content) > 100) {
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
            if (!empty($_POST['categories'])) {
                $categoryId = $_POST['categories'];
                $article->setId($categoryId);
                if (!$article->checkCategoryExistById()) {
                    $errors['categories'] = $messageManager->getMessage('error', 'categories_invalid');
                }
            } else {
                $errors['categories'] = $messageManager->getMessage('error', 'categories_required');
            }
        }
        require_once '../views/elements/header.php';
        require_once '../views/pages/articles/create-article.php';
        require_once '../views/elements/footer.php';

        var_dump($errors);
    }
}
