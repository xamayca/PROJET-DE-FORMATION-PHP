
<div id="single-article">
    <div class="article-header">
        <h1><?= htmlspecialchars($article->title) ?></h1>
        <h3>Written by <?= htmlspecialchars($article->author) ?></h3>
        <h5><?= htmlspecialchars($article->published_date_fr) ?></h5>
    </div>

    <div class="article-cover">
        <img src="/assets/img/uploads/covers-articles/<?= htmlspecialchars($article->cover) ?>" alt="Image of the article">
    </div>

    <div class="article-content">
        <p><?= htmlspecialchars($article->content) ?></p>
    </div>
</div>