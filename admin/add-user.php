<?php
// admin/add-user.php
// Admin page to add new users (admin/staff) to the platform.
session_start();
require_once '../includes/auth.php';
require_login(); // Only admins can add users
require_once '../includes/header.php';
require_once '../includes/db.php';

// Robust input validation and output escaping
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $role = $_POST['role'] ?? 'staff';
    // Validate username (letters, numbers, 3-30 chars)
    if (!$username || !preg_match('/^[a-zA-Z0-9_\-]{3,30}$/', $username)) {
        $error = 'Please enter a valid username (letters, numbers, 3-30 chars).';
    } elseif (!$password || strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } elseif (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (!in_array($role, ['admin', 'staff'])) {
        $error = 'Invalid role selected.';
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare('INSERT INTO users (username, password_hash, email, role) VALUES (?, ?, ?, ?)');
            $stmt->execute([
                htmlspecialchars($username),
                $password_hash,
                htmlspecialchars($email),
                htmlspecialchars($role)
            ]);
            $success = 'User added successfully.';
        } catch (PDOException $e) {
            // Generic error message for security
            $error = 'An error occurred while adding the user.';
        }
    }
}
?>
<div class="container">
    <h2>Add New User</h2>
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
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
        </select><br>
        <button type="submit">Add User</button>
    </form>
    <p><a href="users.php">Back to User Management</a></p>
</div>
<?php
require_once '../includes/footer.php';
?>
