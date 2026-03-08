<?php
// admin/webmaster-login.php
// Webmaster login form
require_once '../includes/header.php';
require_once '../includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $error = 'Username and password are required.';
    } else {
        $stmt = $pdo->prepare('SELECT id, password_hash, username FROM users WHERE username = ? AND role = "webmaster"');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password_hash'])) {
            session_start();
            $_SESSION['webmaster_id'] = $user['id'];
            $_SESSION['webmaster_username'] = $user['username'];
            header('Location: webmaster-dashboard.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>
<div class="container">
    <h2>Webmaster Login</h2>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</div>
<?php
require_once '../includes/footer.php';
?>
