<h1>Articles in the category: <?=  (!empty($articles)) ? $articles[0]->name : 'No Articles in this Category Available' ?></h1>

<?php if (empty($articles)): ?>
    <p>No articles were found for this category.</p>
<?php else: ?>
    <?php foreach ($articles as $article): ?>
        <div class="article">
            <h2><?= htmlspecialchars($article->title) ?></h2>
            <div>
                <img src="<?= htmlspecialchars($article->cover) ?>" alt="Article cover">
            </div>
            <p><?= htmlspecialchars($article->content) ?></p>
            <p>Published on: <?= date('F j, Y', strtotime($article->date)) ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

