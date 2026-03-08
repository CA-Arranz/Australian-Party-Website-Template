<?php
// modules/events.php
// Event management module: registration, admin controls, export
// To be included in events and admin pages

require_once __DIR__.'/../includes/db.php';

class Events {
    // Register a new event
    public static function register($data) {
        $stmt = $GLOBALS['pdo']->prepare('INSERT INTO events (title, description, date, location, map_link) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['title'],
            $data['description'],
            $data['date'],
            $data['location'],
            $data['map_link']
        ]);
        return $GLOBALS['pdo']->lastInsertId();
    }

    // Get all events
    public static function getAll() {
        $stmt = $GLOBALS['pdo']->query('SELECT * FROM events ORDER BY date ASC');
        return $stmt->fetchAll();
    }

    // Edit event
    public static function edit($event_id, $data) {
        $stmt = $GLOBALS['pdo']->prepare('UPDATE events SET title = ?, description = ?, date = ?, location = ?, map_link = ? WHERE id = ?');
        $stmt->execute([
            $data['title'],
            $data['description'],
            $data['date'],
            $data['location'],
            $data['map_link'],
            $event_id
        ]);
    }
}
