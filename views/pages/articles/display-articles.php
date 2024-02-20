    <h1>Articles dans la catégorie: <?=  (!empty($articles)) ? $articles[0]->name : 'Aucun article disponible.' ?></h1>

    <button id="create-article-button" onclick="window.location.href = '/creer-un-article'">Crée un article</button>

    <?php if (empty($articles)): ?>
        <p>Aucun article disponible dans cette catégorie.</p>
    <?php else: ?>


    <?php foreach ($articles as $article): ?>
    <div id="article">

        <div class="article-header">
            <h2 class="article-title">
                <?= htmlspecialchars($article->title) ?>
                <img id="author-avatar" src="/assets/img/uploads/users-avatars/<?= htmlspecialchars($article->authorAvatar) ?>" alt="Avatar de l'auteur">
            </h2>

            <div class="article-cover">
                <img src="/assets/img/uploads/covers-articles/<?= htmlspecialchars($article->cover) ?>" alt="Image de l'article">
            </div>


            <div class="article-content">
                <p>
                    <?= htmlspecialchars($article->content) ?>
                </p>
            </div>

            <p class="article-footer">Publié <?= htmlspecialchars($article->published_date_fr) ?> par <?= htmlspecialchars($article->author) ?></p>

        </div>

        <?php endforeach; ?>
    <?php endif; ?>
    </div>