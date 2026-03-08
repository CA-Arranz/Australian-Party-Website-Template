<?php
// modules/transparency.php
// Transparency module: compliance reports, finance summaries, downloadable documents
// To be included in transparency and admin pages

require_once __DIR__.'/../includes/db.php';

class Transparency {
    // Get public donations for disclosure
    public static function getDonations() {
        $stmt = $GLOBALS['pdo']->query('SELECT donor_name, amount, date FROM donations WHERE public_disclosure = 1 ORDER BY date DESC');
        return $stmt->fetchAll();
    }

    // Get compliance reports (stub for future expansion)
    public static function getReports() {
        // Placeholder: fetch from database or file system
        return [];
    }

    // Get finance summaries (stub for future expansion)
    public static function getFinanceSummaries() {
        // Placeholder: fetch from database or file system
        return [];
    }
}
