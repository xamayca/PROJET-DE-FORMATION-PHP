<form id="create-article-form" action="/creer-un-article" method="POST" enctype="multipart/form-data">
    <h1>Écrire un article</h1>

    <div class="form-group">
        <label for="title">Titre de l'article</label>
        <div class="input-with-icon">
            <input type="text" name="title" id="title" placeholder="Entrez le titre de l'article">
            <i class="fas fa-pen"></i>
        </div>
        <?php if (isset($errors['title'])): ?>
            <div class="form-error">
                <p><?= $errors['title'] ?></p>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="cover">Image de couverture</label>
        <div class="input-with-icon">
            <label for="cover" class="custom-file-upload">
                Choisir un fichier
            </label>
            <input type="file" id="cover" name="cover" accept="image/*"/>
        </div>
        <?php if (isset($errors['cover'])): ?>
            <div class="form-error">
                <p><?= $errors['cover'] ?></p>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="categories">Catégorie de l'article</label>
        <div class="input-with-icon">
            <select name="categories" id="categories">
                <option selected disabled>Choisissez une catégorie</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if (isset($errors['categories'])): ?>
            <div class="form-error">
                <p><?= $errors['categories'] ?></p>
            </div>
        <?php endif; ?>
    </div>


    <div class="form-group">
        <label for="content">Contenu de l'article</label>
        <div class="input-with-icon">
            <textarea name="content" id="content" placeholder="Entrez le contenu de l'article"></textarea>
            <i class="fas fa-message"></i>
        </div>
        <?php if (isset($errors['content'])): ?>
            <div class="form-error">
                <p><?= $errors['content'] ?></p>
            </div>
        <?php endif; ?>
    </div>


    <button type="submit" class="validate-btn">Crée l'article</button>

</form>
