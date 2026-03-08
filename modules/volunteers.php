<?php
// modules/volunteers.php
// Volunteer management module: registration, admin management, export
// To be included in volunteer and admin pages

require_once __DIR__.'/../includes/db.php';

class Volunteers {
    // Register a new volunteer
    public static function register($data) {
        $stmt = $GLOBALS['pdo']->prepare('INSERT INTO volunteers (name, email, phone, postcode, skills, availability, assigned_role) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['postcode'],
            $data['skills'],
            $data['availability'],
            $data['assigned_role']
        ]);
        return $GLOBALS['pdo']->lastInsertId();
    }

    // Get all volunteers
    public static function getAll() {
        $stmt = $GLOBALS['pdo']->query('SELECT * FROM volunteers');
        return $stmt->fetchAll();
    }

    // Assign role to volunteer
    public static function assignRole($volunteer_id, $role) {
        $stmt = $GLOBALS['pdo']->prepare('UPDATE volunteers SET assigned_role = ? WHERE id = ?');
        $stmt->execute([$role, $volunteer_id]);
    }
}
