
<?php
// news.php
// Displays a list of news posts and media releases for the campaign.
// Fetches news from the database and includes header and footer for consistent layout.
require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/db.php';

// Fetch all news posts from the database, ordered by published date (newest first)
$stmt = $pdo->query('SELECT * FROM news_posts ORDER BY published_at DESC');
$news = $stmt->fetchAll();
?>

<section aria-label="News & Media Releases" tabindex="0">
    <h2>News & Media Releases</h2>
    <ul aria-label="News List">
        <?php foreach ($news as $post): ?>
            <li>
                <!-- News post title -->
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <!-- News post content -->
                <div><?= nl2br(htmlspecialchars($post['content'])) ?></div>
                <!-- News post published date -->
                <small>Published: <?= htmlspecialchars($post['published_at']) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php
// Include footer for consistent site navigation
require_once __DIR__.'/includes/footer.php';
