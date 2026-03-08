<?php
// admin/webmaster-dashboard.php
// Simple webmaster dashboard after login
require_once '../includes/header.php';
session_start();
if (!isset($_SESSION['webmaster_id'])) {
    header('Location: webmaster-login.php');
    exit;
}
?>
<div class="container">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['webmaster_username']) ?>!</h2>
    <p>You are logged in as webmaster.</p>
    <a href="webmaster-logout.php">Logout</a>
</div>
<?php
require_once '../includes/footer.php';
?>
