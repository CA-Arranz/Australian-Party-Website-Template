
<?php
// admin/login.php
// Admin login page. Handles authentication and displays login form.
session_start();
require_once '../includes/auth.php';
require_once '../includes/header.php';

$error = '';
// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    // Attempt login
    if (login($username, $password)) {
        // Redirect to admin dashboard on success
        header('Location: index.php');
        exit;
    } else {
        // Show error message on failure
        $error = 'Invalid username or password.';
    }
}
?>

<div class="container">
    <h2>Admin Login</h2>
    <!-- Display error message if login fails -->
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
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
