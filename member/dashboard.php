<?php
// member/dashboard.php
// Simple member dashboard after login
require_once '../includes/header.php';
session_start();
if (!isset($_SESSION['member_id'])) {
    header('Location: login.php');
    exit;
}
?>
<div class="container">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['member_name']) ?>!</h2>
    <p>You are registered as a party member.</p>
    <a href="logout.php">Logout</a>
</div>
<?php
require_once '../includes/footer.php';
?>
