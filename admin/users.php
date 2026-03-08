
<?php
// admin/users.php
// User management dashboard for admins. Lists all users and provides edit/delete/add actions.
session_start();
require_once '../includes/auth.php';
require_login(); // Redirects to login if not authenticated
require_once '../includes/header.php';
require_once '../includes/db.php';

// Fetch all users from the database
$stmt = $pdo->query('SELECT id, username, role FROM users ORDER BY id');
$users = $stmt->fetchAll();

?>

<div class="container">
    <h2>User Management</h2>
    <!-- User table listing all users -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <!-- Edit and delete user actions -->
                        <a href="edit-user.php?id=<?= urlencode($user['id']) ?>">Edit</a> |
                        <a href="delete-user.php?id=<?= urlencode($user['id']) ?>" onclick="return confirm('Delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Link to add new user -->
    <p><a href="add-user.php">Add New User</a></p>
</div>

<?php
// Include footer for consistent site navigation
require_once '../includes/footer.php';
?>
