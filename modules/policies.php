<?php
// modules/policies.php
// Policy management module: publishing, categories, admin controls
// To be included in policies and admin pages

require_once __DIR__.'/../includes/db.php';

class Policies {
    // Register a new policy
    public static function register($data) {
        $stmt = $GLOBALS['pdo']->prepare('INSERT INTO policies (title, category, content) VALUES (?, ?, ?)');
        $stmt->execute([
            $data['title'],
            $data['category'],
            $data['content']
        ]);
        return $GLOBALS['pdo']->lastInsertId();
    }

    // Get all policies
    public static function getAll() {
        $stmt = $GLOBALS['pdo']->query('SELECT * FROM policies');
        return $stmt->fetchAll();
    }

    // Edit policy
    public static function edit($policy_id, $data) {
        $stmt = $GLOBALS['pdo']->prepare('UPDATE policies SET title = ?, category = ?, content = ? WHERE id = ?');
        $stmt->execute([
            $data['title'],
            $data['category'],
            $data['content'],
            $policy_id
        ]);
    }
}
