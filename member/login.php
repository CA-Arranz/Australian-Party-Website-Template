<?php
// member/login.php
// Party member login form
require_once '../includes/header.php';
require_once '../includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $error = 'Email and password are required.';
    } else {
        $stmt = $pdo->prepare('SELECT id, password_hash, full_name FROM members WHERE email = ?');
        $stmt->execute([$email]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($member && password_verify($password, $member['password_hash'])) {
            session_start();
            $_SESSION['member_id'] = $member['id'];
            $_SESSION['member_name'] = $member['full_name'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid email or password.';
        }
    }
}
?>
<div class="container">
    <h2>Member Login</h2>
    <?php if ($error): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</div>
<?php
require_once '../includes/footer.php';
?>
