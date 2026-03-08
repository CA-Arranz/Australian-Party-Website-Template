
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
    $contactError = '';
    $contactSuccess = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['message'], $_POST['csrf_token'])) {
        // Validate CSRF token
        if (!csrf_check($_POST['csrf_token'])) {
            $contactError = 'Invalid CSRF token.';
        } else {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $message = trim($_POST['message']);
            // Validate name (letters, spaces, min 2, max 50)
            if (!preg_match('/^[a-zA-Z\s\-]{2,50}$/', $name)) {
                $contactError = 'Please enter a valid name (letters, spaces, 2-50 chars).';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $contactError = 'Please enter a valid email address.';
            } elseif (strlen($message) < 10 || strlen($message) > 1000) {
                $contactError = 'Message must be between 10 and 1000 characters.';
            } else {
                // Store message in the database
                $stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)');
                $stmt->execute([
                    htmlspecialchars($name),
                    htmlspecialchars($email),
                    htmlspecialchars($message)
                ]);
                $contactSuccess = 'Thank you for contacting us!';
            }
        }
    }
    if ($contactError) {
        echo '<div class="error-message" role="alert">' . htmlspecialchars($contactError) . '</div>';
    }
    if ($contactSuccess) {
        echo '<div class="success-message" role="status">' . htmlspecialchars($contactSuccess) . '</div>';
    }
    ?>
</section>

<?php
// Include footer for consistent site navigation
require_once __DIR__.'/includes/footer.php';
