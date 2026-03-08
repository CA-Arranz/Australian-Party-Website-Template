<?php
// admin/webmaster-create-account.php
// Webmaster account creation form
require_once '../includes/header.php';
require_once '../includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    // Validate username (letters, numbers, 3-30 chars)
    if (!$username || !preg_match('/^[a-zA-Z0-9_\-]{3,30}$/', $username)) {
        $error = 'Please enter a valid username (letters, numbers, 3-30 chars).';
    } elseif (!$password || strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare('INSERT INTO users (username, password_hash, role) VALUES (?, ?, "webmaster")');
            $stmt->execute([
                htmlspecialchars($username),
                $password_hash
            ]);
            $success = 'Webmaster account created successfully.';
        } catch (PDOException $e) {
            $error = 'An error occurred while creating the account.';
        }
    }
}
?>
<div class="container">
    <h2>Create Webmaster Account</h2>
    <?php if ($error): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="success-message"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Create Account</button>
    </form>
</div>
<?php
require_once '../includes/footer.php';
?>
