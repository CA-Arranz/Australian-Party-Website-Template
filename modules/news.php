<?php
// modules/news.php
// News/media management module: publishing, admin controls, export
// To be included in news and admin pages

require_once __DIR__.'/../includes/db.php';

class News {
    // Register a new news post
    public static function register($data) {
        $stmt = $GLOBALS['pdo']->prepare('INSERT INTO news_posts (title, content) VALUES (?, ?)');
        $stmt->execute([
            $data['title'],
            $data['content']
        ]);
        return $GLOBALS['pdo']->lastInsertId();
    }

    // Get all news posts
    public static function getAll() {
        $stmt = $GLOBALS['pdo']->query('SELECT * FROM news_posts ORDER BY published_at DESC');
        return $stmt->fetchAll();
    }

    // Edit news post
    public static function edit($news_id, $data) {
        $stmt = $GLOBALS['pdo']->prepare('UPDATE news_posts SET title = ?, content = ? WHERE id = ?');
        $stmt->execute([
            $data['title'],
            $data['content'],
            $news_id
        ]);
    }
}
