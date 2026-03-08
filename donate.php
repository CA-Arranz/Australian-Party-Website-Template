
<?php
// donate.php
// Displays a donation form for users to contribute to the campaign.
// Handles form submission, CSRF protection, and stores donation details in the database.
// Includes header and footer for consistent layout.
require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/csrf.php';
?>

<section aria-label="Donate" tabindex="0">
    <h2>Donate</h2>
    <!-- Donation form for campaign contributions -->
    <form method="post" action="donate.php" aria-label="Donation Form">
        <?= csrf_input() ?>
        <label for="donor_name">Name:</label>
        <input type="text" id="donor_name" name="donor_name" required>
        <label for="amount">Amount (AUD):</label>
        <input type="number" id="amount" name="amount" min="1" step="0.01" required>
        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method">
            <option value="cash">Cash</option>
            <option value="bank">Bank Transfer</option>
            <option value="cheque">Cheque</option>
        </select>
        <label for="public_disclosure">Public Disclosure:</label>
        <select id="public_disclosure" name="public_disclosure">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <button type="submit" class="btn">Donate</button>
    </form>

    <?php
    // Handle donation form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['donor_name'], $_POST['amount'], $_POST['csrf_token'])) {
        // Validate CSRF token
        if (csrf_check($_POST['csrf_token'])) {
            // Store donation details in the database
            $stmt = $pdo->prepare('INSERT INTO donations (donor_name, amount, payment_method, public_disclosure) VALUES (?, ?, ?, ?)');
            $stmt->execute([
                htmlspecialchars($_POST['donor_name']),
                floatval($_POST['amount']),
                htmlspecialchars($_POST['payment_method']),
                intval($_POST['public_disclosure'])
            ]);
            echo '<p>Thank you for your donation!</p>';
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
