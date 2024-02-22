<h1>Articles dans la catégorie: <?=  (!empty($articles)) ? $articles[0]->name : 'Aucun article disponible.' ?></h1>

<button id="create-article-button" onclick="window.location.href = '/creer-un-article'">Crée un article</button>

<?php if (empty($articles)): ?>
    <p>Aucun article disponible dans cette catégorie.</p>

<?php else: ?>

    <?php foreach ($articles as $article): ?>
        <div id="article">
            <div class="article-header">
                <h2 class="article-title">
                    <?= $article->title ?>
                    <img id="author-avatar" src="/assets/img/uploads/users-avatars/<?= $article->authorAvatar ?>" alt="Avatar de l'auteur">
                </h2>

                <div class="article-cover">
                    <img src="/assets/img/uploads/covers-articles/<?= $article->cover ?>" alt="Image de l'article">
                    <span id="categories">
                        <?= $articles[0]->name ?>
                    </span>
                </div>


                <div class="article-content">

                    <p>
                        <?= strip_tags($article->content) ?>...

                        <span id="article-info">
                            Publié <?= $article->published_date_fr ?> par <?= $article->author ?>
                        </span>
                    </p>



                    <a id="read-more-button" href="/actualite/<?= urlencode($article->name) ?>/<?= $article->id ?>">Lire l'article</a>
                </div>


            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>