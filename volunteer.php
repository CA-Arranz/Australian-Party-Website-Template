<?php
// Include header, database connection, and CSRF protection
require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/csrf.php';
?>

<section aria-label="Volunteer Signup" tabindex="0">
    <h2>Volunteer Signup</h2>
    <!-- Volunteer registration form -->
    <form method="post" action="volunteer.php" aria-label="Volunteer Registration Form">
        <?= csrf_input() ?> <!-- CSRF token for security -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone">
        <label for="postcode">Postcode:</label>
        <input type="text" id="postcode" name="postcode">
        <label for="skills">Skills:</label>
        <input type="text" id="skills" name="skills">
        <label for="availability">Availability:</label>
        <input type="text" id="availability" name="availability">
        <button type="submit" class="btn">Register</button>
    </form>

    <?php
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['csrf_token'])) {
        // Validate CSRF token
        if (csrf_check($_POST['csrf_token'])) {
            // Insert volunteer data into the database
            $stmt = $pdo->prepare('INSERT INTO volunteers (name, email, phone, postcode, skills, availability) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([
                htmlspecialchars($_POST['name']),
                htmlspecialchars($_POST['email']),
                htmlspecialchars($_POST['phone']),
                htmlspecialchars($_POST['postcode']),
                htmlspecialchars($_POST['skills']),
                htmlspecialchars($_POST['availability'])
            ]);
            // Success message
            echo '<p>Thank you for registering as a volunteer!</p>';
        } else {
            // CSRF token error message
            echo '<p>Invalid CSRF token.</p>';
        }
    }
    ?>
</section>

<?php
// Include footer
require_once __DIR__.'/includes/footer.php';
