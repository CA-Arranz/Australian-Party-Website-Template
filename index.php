
<?php
// index.php
// Homepage of the platform. Provides links to key features: volunteer signup, donations, policies, and candidate profiles.
// Includes header and footer for consistent layout.

require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/csrf.php';
require_once __DIR__.'/modules/news.php';
require_once __DIR__.'/modules/policies.php';

$newsletter_error = '';
$newsletter_success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newsletter_email'])) {
    // Rate limiting: max 5 submissions per IP per hour
    $ip = $_SERVER['REMOTE_ADDR'];
    $rateLimitFile = sys_get_temp_dir() . '/newsletter_rate_limit_' . md5($ip);
    $rateLimit = @json_decode(@file_get_contents($rateLimitFile), true) ?: ['count'=>0,'time'=>time()];
    if (time() - $rateLimit['time'] > 3600) {
        $rateLimit = ['count'=>0,'time'=>time()];
    }
    if ($rateLimit['count'] >= 5) {
        $newsletter_error = 'Too many submissions from your IP. Please try again later.';
    } else {
        $email = trim($_POST['newsletter_email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $newsletter_error = 'Please enter a valid email address.';
        } else if (!csrf_check($_POST['csrf_token'] ?? '')) {
            $newsletter_error = 'Invalid form submission.';
        } else {
            // Validate reCAPTCHA
            $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
            $recaptchaSecret = 'YOUR_RECAPTCHA_SECRET_KEY';
            $recaptchaVerify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($recaptchaSecret) . '&response=' . urlencode($recaptchaResponse) . '&remoteip=' . urlencode($ip));
            $recaptchaResult = json_decode($recaptchaVerify, true);
            if (!$recaptchaResult['success']) {
                $newsletter_error = 'CAPTCHA verification failed. Please try again.';
            } else {
                // Insert into newsletter_subscribers table
                $stmt = $pdo->prepare('INSERT IGNORE INTO newsletter_subscribers (email, subscribed_at) VALUES (?, NOW())');
                $stmt->execute([$email]);
                $newsletter_success = 'Thank you for subscribing!';
                // Update rate limit
                $rateLimit['count']++;
                file_put_contents($rateLimitFile, json_encode($rateLimit));
            }
        }
    }
}

// Fetch latest news (top 3)
$latest_news = News::getAll();
if (count($latest_news) > 3) $latest_news = array_slice($latest_news, 0, 3);
// Fetch featured policies (top 3)
$featured_policies = Policies::getAll();
if (count($featured_policies) > 3) $featured_policies = array_slice($featured_policies, 0, 3);

?>

<section class="hero" aria-label="Campaign Hero" tabindex="0">
    <div class="hero-content">
        <h1 class="hero-title">A Brighter Future for All Australians</h1>
        <p class="hero-slogan">United for Progress. Committed to Community. Driven by Values.</p>
        <div class="cta-buttons">
            <a href="member/register.php" class="btn btn-lg btn-lg" aria-label="Join the Party">Join the Party</a>
            <a href="volunteer.php" class="btn btn-lg btn-outline" aria-label="Volunteer">Volunteer</a>
            <a href="donate.php" class="btn btn-lg btn-accent" aria-label="Donate">Donate</a>
        </div>
    </div>
</section>

<section class="home-panels">
    <div class="panel news-panel" aria-label="Latest News">
        <h2>Latest News</h2>
        <ul class="card-list">
            <?php foreach ($latest_news as $post): ?>
                <li class="card">
                    <h3><?= htmlspecialchars($post['title']) ?></h3>
                    <div><?= nl2br(htmlspecialchars($post['content'])) ?></div>
                    <small>Published: <?= htmlspecialchars($post['published_at']) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="news.php" class="btn btn-sm">View All News</a>
    </div>
    <div class="panel policies-panel" aria-label="Featured Policies">
        <h2>Featured Policies</h2>
        <ul class="card-list">
            <?php foreach ($featured_policies as $policy): ?>
                <li class="card">
                    <h3><?= htmlspecialchars($policy['title']) ?></h3>
                    <strong>Category:</strong> <?= htmlspecialchars($policy['category']) ?><br>
                    <div><?= nl2br(htmlspecialchars($policy['content'])) ?></div>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="policies.php" class="btn btn-sm">View All Policies</a>
    </div>
</section>

<section class="newsletter-panel" aria-label="Newsletter Signup">
    <h2>Subscribe to Our Newsletter</h2>
    <form method="post" action="index.php" class="newsletter-form" aria-label="Newsletter Signup Form">
        <?= csrf_input() ?>
        <label for="newsletter_email">Email:</label>
        <input type="email" id="newsletter_email" name="newsletter_email" required aria-required="true" autocomplete="email">
        <!-- Google reCAPTCHA v2 widget -->
        <div class="g-recaptcha" data-sitekey="YOUR_RECAPTCHA_SITE_KEY"></div>
        <button type="submit" class="btn">Subscribe</button>
    </form>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php if ($newsletter_error): ?>
        <div class="error-message" role="alert"><?= htmlspecialchars($newsletter_error) ?></div>
    <?php endif; ?>
    <?php if ($newsletter_success): ?>
        <div class="success-message" role="status"><?= htmlspecialchars($newsletter_success) ?></div>
    <?php endif; ?>
</section>

<section class="social-panel" aria-label="Connect With Us">
    <h2>Connect With Us</h2>
    <div class="social-links">
        <a href="https://facebook.com/" target="_blank" rel="noopener" aria-label="Facebook" class="social-icon social-icon-facebook">Facebook</a>
        <a href="https://twitter.com/" target="_blank" rel="noopener" aria-label="Twitter" class="social-icon social-icon-twitter">Twitter</a>
        <a href="https://instagram.com/" target="_blank" rel="noopener" aria-label="Instagram" class="social-icon social-icon-instagram">Instagram</a>
        <a href="https://youtube.com/" target="_blank" rel="noopener" aria-label="YouTube" class="social-icon social-icon-youtube">YouTube</a>
        <!-- Add more as needed -->
    </div>
</section>

<?php require_once __DIR__.'/includes/footer.php'; ?>
