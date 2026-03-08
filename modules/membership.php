<?php
// modules/membership.php
// Membership management module: registration, profile, export, verification
// To be included in member and admin pages

require_once __DIR__.'/../includes/db.php';

class Membership {
    // Register a new member
    public static function register($data) {
        $stmt = $GLOBALS['pdo']->prepare('INSERT INTO members (full_name, address, email, date_of_birth, phone, is_elector, not_member_of_other_party, agreed_to_rules, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['full_name'],
            $data['address'],
            $data['email'],
            $data['date_of_birth'],
            $data['phone'],
            $data['is_elector'],
            $data['not_member_of_other_party'],
            $data['agreed_to_rules'],
            $data['password_hash']
        ]);
        return $GLOBALS['pdo']->lastInsertId();
    }

    // Get member by email
    public static function getByEmail($email) {
        $stmt = $GLOBALS['pdo']->prepare('SELECT * FROM members WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Export all members for compliance
    public static function exportAll() {
        $stmt = $GLOBALS['pdo']->query('SELECT * FROM members');
        return $stmt->fetchAll();
    }

    // Update verification status
    public static function verify($member_id, $status) {
        $stmt = $GLOBALS['pdo']->prepare('UPDATE members SET verification_status = ? WHERE id = ?');
        $stmt->execute([$status, $member_id]);
    }
}
