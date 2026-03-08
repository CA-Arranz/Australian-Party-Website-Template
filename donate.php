
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
        <!-- Google reCAPTCHA v2 widget -->
        <div class="g-recaptcha" data-sitekey="YOUR_RECAPTCHA_SITE_KEY"></div>
        <button type="submit" class="btn">Donate</button>
    </form>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <?php
    // Handle donation form submission with robust validation and escaping
    $donationError = '';
    $donationSuccess = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['donor_name'], $_POST['amount'], $_POST['csrf_token'])) {
        // Rate limiting: max 5 submissions per IP per hour
        $ip = $_SERVER['REMOTE_ADDR'];
        $rateLimitFile = sys_get_temp_dir() . '/donate_rate_limit_' . md5($ip);
        $rateLimit = @json_decode(@file_get_contents($rateLimitFile), true) ?: ['count'=>0,'time'=>time()];
        if (time() - $rateLimit['time'] > 3600) {
            $rateLimit = ['count'=>0,'time'=>time()];
        }
        if ($rateLimit['count'] >= 5) {
            $donationError = 'Too many submissions from your IP. Please try again later.';
        } else {
            // Validate CSRF token
            if (!csrf_check($_POST['csrf_token'])) {
                $donationError = 'Invalid CSRF token.';
            } else {
                // Validate reCAPTCHA
                $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
                $recaptchaSecret = 'YOUR_RECAPTCHA_SECRET_KEY';
                $recaptchaVerify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($recaptchaSecret) . '&response=' . urlencode($recaptchaResponse) . '&remoteip=' . urlencode($ip));
                $recaptchaResult = json_decode($recaptchaVerify, true);
                if (!$recaptchaResult['success']) {
                    $donationError = 'CAPTCHA verification failed. Please try again.';
                } else {
                    $donorName = trim($_POST['donor_name']);
                    $amount = trim($_POST['amount']);
                    $paymentMethod = trim($_POST['payment_method'] ?? '');
                    $publicDisclosure = isset($_POST['public_disclosure']) ? $_POST['public_disclosure'] : '1';
                    // Validate donor name (letters, spaces, min 2, max 50)
                    if (!preg_match('/^[a-zA-Z\s\-]{2,50}$/', $donorName)) {
                        $donationError = 'Please enter a valid name (letters, spaces, 2-50 chars).';
                    } elseif (!is_numeric($amount) || floatval($amount) < 1 || floatval($amount) > 100000) {
                        $donationError = 'Please enter a valid donation amount (AUD 1-100,000).';
                    } elseif (!in_array($paymentMethod, ['cash', 'bank', 'cheque'])) {
                        $donationError = 'Invalid payment method.';
                    } elseif (!in_array($publicDisclosure, ['0', '1'])) {
                        $donationError = 'Invalid public disclosure option.';
                    } else {
                        // Store donation details in the database
                        $stmt = $pdo->prepare('INSERT INTO donations (donor_name, amount, payment_method, public_disclosure) VALUES (?, ?, ?, ?)');
                        $stmt->execute([
                            htmlspecialchars($donorName),
                            floatval($amount),
                            htmlspecialchars($paymentMethod),
                            intval($publicDisclosure)
                        ]);
                        $donationSuccess = 'Thank you for your donation!';
                        // Update rate limit
                        $rateLimit['count']++;
                        file_put_contents($rateLimitFile, json_encode($rateLimit));
                    }
                }
            }
        }
    }
    if ($donationError) {
        echo '<div class="error-message" role="alert">' . htmlspecialchars($donationError) . '</div>';
    }
    if ($donationSuccess) {
        echo '<div class="success-message" role="status">' . htmlspecialchars($donationSuccess) . '</div>';
    }
    ?>
</section>

<?php
// Include footer for consistent site navigation
require_once __DIR__.'/includes/footer.php';
