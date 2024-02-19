<?php var_dump($_POST); ?>
<?php var_dump($_FILES); ?>


<form id="create-article-form" action="/article" method="POST" enctype="multipart/form-data">
        <h1>Écrire un article</h1>
        <label for="title">Titre</label>
        <input type="text" name="title" id="title">
        <?php if (isset($errors['title'])): ?>
            <div class="form-error">
                <p><?= $errors['title'] ?></p>
            </div>
        <?php endif; ?>

        <label for="cover">Image de couverture</label>
        <input type="file" name="cover" id="cover">
        <?php if (isset($errors['cover'])): ?>
            <div class="form-error">
                <p><?= $errors['cover'] ?></p>
            </div>
        <?php endif; ?>


        <label for="categories">Catégorie</label>
        <select name="categories" id="categories">
            <option selected disabled>Choisissez une catégorie</option>
            <?php $article = new Article();
            $categories = $article->getCategoriesList();
            foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['categories'])): ?>
            <div class="form-error">
                <p><?= $errors['categories'] ?></p>
            </div>
        <?php endif; ?>

        <label for="content">Contenu</label>
        <textarea name="content" id="content"></textarea>
        <?php if (isset($errors['content'])): ?>
            <div class="form-error">
                <p><?= $errors['content'] ?></p>
            </div>
        <?php endif; ?>

        <input type="submit" value="Créer">
    </form>
