<?php
// modules/candidates.php
// Candidate management module: profile, admin editing, export
// To be included in candidates and admin pages

require_once __DIR__.'/../includes/db.php';

class Candidates {
    // Register a new candidate
    public static function register($data) {
        $stmt = $GLOBALS['pdo']->prepare('INSERT INTO candidates (name, photo, electorate, biography, social_links) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['name'],
            $data['photo'],
            $data['electorate'],
            $data['biography'],
            $data['social_links']
        ]);
        return $GLOBALS['pdo']->lastInsertId();
    }

    // Get all candidates
    public static function getAll() {
        $stmt = $GLOBALS['pdo']->query('SELECT * FROM candidates');
        return $stmt->fetchAll();
    }

    // Edit candidate profile
    public static function edit($candidate_id, $data) {
        $stmt = $GLOBALS['pdo']->prepare('UPDATE candidates SET name = ?, photo = ?, electorate = ?, biography = ?, social_links = ? WHERE id = ?');
        $stmt->execute([
            $data['name'],
            $data['photo'],
            $data['electorate'],
            $data['biography'],
            $data['social_links'],
            $candidate_id
        ]);
    }
}
