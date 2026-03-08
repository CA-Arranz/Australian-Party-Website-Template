
<?php
// contact.php
// Displays a contact form for users to send messages to the campaign.
// Handles form submission, CSRF protection, and stores messages in the database.
// Includes header and footer for consistent layout.
require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/csrf.php';
?>

<section aria-label="Contact" tabindex="0">
    <h2>Contact</h2>
    <!-- Contact form for user messages -->
    <form method="post" action="contact.php" aria-label="Contact Form">
        <?= csrf_input() ?>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <button type="submit" class="btn">Send</button>
    </form>

    <?php
    // Handle contact form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['message'], $_POST['csrf_token'])) {
        // Validate CSRF token
        if (csrf_check($_POST['csrf_token'])) {
            // Store message in the database
            $stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)');
            $stmt->execute([
                htmlspecialchars($_POST['name']),
                htmlspecialchars($_POST['email']),
                htmlspecialchars($_POST['message'])
            ]);
            echo '<p>Thank you for contacting us!</p>';
        } else {
            // CSRF token invalid
            echo '<p>Invalid CSRF token.</p>';
        }
    }
    ?>
</section>

<?php
// Include footer for consistent site navigation
require_once __DIR__.'/includes/footer.php';
