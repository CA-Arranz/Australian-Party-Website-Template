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
        <!-- Google reCAPTCHA v2 widget -->
        <div class="g-recaptcha" data-sitekey="YOUR_RECAPTCHA_SITE_KEY"></div>
        <button type="submit" class="btn">Register</button>
    </form>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <?php
    // Handle form submission with robust validation and escaping
    $volunteerError = '';
    $volunteerSuccess = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['csrf_token'])) {
        // Rate limiting: max 5 submissions per IP per hour
        $ip = $_SERVER['REMOTE_ADDR'];
        $rateLimitFile = sys_get_temp_dir() . '/volunteer_rate_limit_' . md5($ip);
        $rateLimit = @json_decode(@file_get_contents($rateLimitFile), true) ?: ['count'=>0,'time'=>time()];
        if (time() - $rateLimit['time'] > 3600) {
            $rateLimit = ['count'=>0,'time'=>time()];
        }
        if ($rateLimit['count'] >= 5) {
            $volunteerError = 'Too many submissions from your IP. Please try again later.';
        } else {
            // Validate CSRF token
            if (!csrf_check($_POST['csrf_token'])) {
                $volunteerError = 'Invalid CSRF token.';
            } else {
                // Validate reCAPTCHA
                $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
                $recaptchaSecret = 'YOUR_RECAPTCHA_SECRET_KEY';
                $recaptchaVerify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($recaptchaSecret) . '&response=' . urlencode($recaptchaResponse) . '&remoteip=' . urlencode($ip));
                $recaptchaResult = json_decode($recaptchaVerify, true);
                if (!$recaptchaResult['success']) {
                    $volunteerError = 'CAPTCHA verification failed. Please try again.';
                } else {
                    $name = trim($_POST['name']);
                    $email = trim($_POST['email']);
                    $phone = trim($_POST['phone'] ?? '');
                    $postcode = trim($_POST['postcode'] ?? '');
                    $skills = trim($_POST['skills'] ?? '');
                    $availability = trim($_POST['availability'] ?? '');
                    // Validate name (letters, spaces, min 2, max 50)
                    if (!preg_match('/^[a-zA-Z\s\-]{2,50}$/', $name)) {
                        $volunteerError = 'Please enter a valid name (letters, spaces, 2-50 chars).';
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $volunteerError = 'Please enter a valid email address.';
                    } elseif ($phone && !preg_match('/^\+?[0-9\s\-]{7,20}$/', $phone)) {
                        $volunteerError = 'Please enter a valid phone number.';
                    } elseif ($postcode && !preg_match('/^\d{4}$/', $postcode)) {
                        $volunteerError = 'Please enter a valid 4-digit postcode.';
                    } elseif ($skills && strlen($skills) > 100) {
                        $volunteerError = 'Skills description is too long (max 100 chars).';
                    } elseif ($availability && strlen($availability) > 100) {
                        $volunteerError = 'Availability description is too long (max 100 chars).';
                    } else {
                        // Insert volunteer data into the database
                        $stmt = $pdo->prepare('INSERT INTO volunteers (name, email, phone, postcode, skills, availability) VALUES (?, ?, ?, ?, ?, ?)');
                        $stmt->execute([
                            htmlspecialchars($name),
                            htmlspecialchars($email),
                            htmlspecialchars($phone),
                            htmlspecialchars($postcode),
                            htmlspecialchars($skills),
                            htmlspecialchars($availability)
                        ]);
                        $volunteerSuccess = 'Thank you for registering as a volunteer!';
                        // Update rate limit
                        $rateLimit['count']++;
                        file_put_contents($rateLimitFile, json_encode($rateLimit));
                    }
                }
            }
        }
    }
    if ($volunteerError) {
        echo '<div class="error-message" role="alert">' . htmlspecialchars($volunteerError) . '</div>';
    }
    if ($volunteerSuccess) {
        echo '<div class="success-message" role="status">' . htmlspecialchars($volunteerSuccess) . '</div>';
    }
    ?>
</section>

<?php
// Include footer
require_once __DIR__.'/includes/footer.php';
