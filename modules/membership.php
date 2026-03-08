<?php
// modules/membership.php
// Membership management module: registration, profile, export, verification
// To be included in member and admin pages

require_once __DIR__.'/../includes/db.php';

class Membership {
    // Register a new member
    public static function register($data) {
        $stmt = $GLOBALS['pdo']->prepare('INSERT INTO members (fullName, address, email, dateOfBirth, phone, isElector, notMemberOfOtherParty, agreedToRules, passwordHash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['fullName'],
            $data['address'],
            $data['email'],
            $data['dateOfBirth'],
            $data['phone'],
            $data['isElector'],
            $data['notMemberOfOtherParty'],
            $data['agreedToRules'],
            $data['passwordHash']
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
    public static function verify($memberId, $status) {
        $stmt = $GLOBALS['pdo']->prepare('UPDATE members SET verificationStatus = ? WHERE id = ?');
        $stmt->execute([$status, $memberId]);
    }
}
