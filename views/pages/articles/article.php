<h1><?= $articleData->title ?></h1>

<div id="article-content">
    <img src="/assets/img/uploads/covers-articles/<?= $articleData->cover ?>" alt="Image de l'article">
    <p><?= $articleData->content ?></p>
</div>

<a href="/actualite/<?= urlencode($articleData->categoryName) ?>">Retour à la liste des articles</a>