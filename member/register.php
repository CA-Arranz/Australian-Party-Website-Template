<?php
// member/register.php
// Party membership registration form (compliant with VEC requirements)
require_once '../includes/header.php';
require_once '../includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $date_of_birth = $_POST['date_of_birth'] ?? null;
    $phone = trim($_POST['phone'] ?? '');
    $is_elector = isset($_POST['is_elector']) ? 1 : 0;
    $not_member_of_other_party = isset($_POST['not_member_of_other_party']) ? 1 : 0;
    $agreed_to_rules = isset($_POST['agreed_to_rules']) ? 1 : 0;
    $password = $_POST['password'] ?? '';

    if (!$full_name || !$address || !$email || !$password || !$is_elector || !$not_member_of_other_party || !$agreed_to_rules) {
        $error = 'All required fields and confirmations must be completed.';
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare('INSERT INTO members (full_name, address, email, date_of_birth, phone, is_elector, not_member_of_other_party, agreed_to_rules, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$full_name, $address, $email, $date_of_birth, $phone, $is_elector, $not_member_of_other_party, $agreed_to_rules, $password_hash]);
            $success = 'Registration successful! You can now log in.';
        } catch (PDOException $e) {
            $error = 'Error: ' . $e->getMessage();
        }
    }
}
?>
<div class="container">
    <h2>Party Membership Registration</h2>
    <?php if ($error): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="success-message"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br>
        <label for="address">Residential Address:</label>
        <input type="text" id="address" name="address" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth"><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"><br>
        <input type="checkbox" id="is_elector" name="is_elector" required>
        <label for="is_elector">I am enrolled to vote in Victoria</label><br>
        <input type="checkbox" id="not_member_of_other_party" name="not_member_of_other_party" required>
        <label for="not_member_of_other_party">I am not a member of another registered political party or a party applying for registration</label><br>
        <input type="checkbox" id="agreed_to_rules" name="agreed_to_rules" required>
        <label for="agreed_to_rules">I agree to the party rules/constitution</label><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</div>
<?php
require_once '../includes/footer.php';
?>
