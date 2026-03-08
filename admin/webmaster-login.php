<?php
// admin/webmaster-login.php
// Webmaster login form
require_once '../includes/header.php';
require_once '../includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    // Validate username (letters, numbers, 3-30 chars)
    if (!$username || !preg_match('/^[a-zA-Z0-9_\-]{3,30}$/', $username)) {
        $error = 'Please enter a valid username.';
    } elseif (!$password || strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } else {
        $stmt = $pdo->prepare('SELECT id, password_hash, username FROM users WHERE username = ? AND role = "webmaster"');
        $stmt->execute([htmlspecialchars($username)]);
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
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
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
