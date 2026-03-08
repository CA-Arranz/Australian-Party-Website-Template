
<?php
// db.php
// Secure database connection using PDO. Loads config and sets up $pdo for use throughout the platform.
require_once __DIR__.'/config.php';

try {
    // Create PDO instance for MySQL connection
    $pdo = new PDO(
        "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch associative arrays by default
            PDO::ATTR_EMULATE_PREPARES => false // Use native prepared statements
        ]
    );
} catch (PDOException $e) {
    // Handle connection errors gracefully
    die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
}
