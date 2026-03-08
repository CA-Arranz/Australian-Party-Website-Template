<?php
// modules/donations.php
// Donation management module: tracking, admin management, disclosure, export
// To be included in donate and admin pages

require_once __DIR__.'/../includes/db.php';

class Donations {
    // Register a new donation
    public static function register($data) {
        $stmt = $GLOBALS['pdo']->prepare('INSERT INTO donations (donor_name, amount, payment_method, public_disclosure) VALUES (?, ?, ?, ?)');
        $stmt->execute([
            $data['donor_name'],
            $data['amount'],
            $data['payment_method'],
            $data['public_disclosure']
        ]);
        return $GLOBALS['pdo']->lastInsertId();
    }

    // Get all donations
    public static function getAll() {
        $stmt = $GLOBALS['pdo']->query('SELECT * FROM donations');
        return $stmt->fetchAll();
    }

    // Get public disclosures
    public static function getPublic() {
        $stmt = $GLOBALS['pdo']->query('SELECT donor_name, amount, date FROM donations WHERE public_disclosure = 1 ORDER BY date DESC');
        return $stmt->fetchAll();
    }
}
