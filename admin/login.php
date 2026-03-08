
<?php
// admin/login.php
// Admin login page. Handles authentication and displays login form.
session_start();
require_once '../includes/auth.php';
require_once '../includes/header.php';

// Robust input validation and output escaping
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$username || !preg_match('/^[a-zA-Z0-9_\-]{3,30}$/', $username)) {
        $error = 'Please enter a valid username.';
    } elseif (!$password || strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } else {
        if (login($username, $password)) {
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>

<div class="container">
    <h2>Admin Login</h2>
    <!-- Display error message if login fails -->
    <?php if ($error): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <!-- Login form -->
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</div>

<?php
// Include footer for consistent site navigation
require_once '../includes/footer.php';
?>
