
<?php
// index.php
// Homepage of the platform. Provides links to key features: volunteer signup, donations, policies, and candidate profiles.
// Includes header and footer for consistent layout.
require_once __DIR__.'/includes/header.php';
?>

<section aria-label="Home" tabindex="0">
    <!-- Site welcome heading -->
    <h1>Welcome to <?= htmlspecialchars($SITE_NAME) ?></h1>
    <!-- Platform description -->
    <p>This platform empowers Australian political campaigns to manage volunteers, events, policies, candidates, donations, outreach, and compliance transparently and securely.</p>
    <!-- Navigation buttons to main features -->
    <a href="volunteer.php" class="btn" aria-label="Volunteer Signup">Volunteer</a>
    <a href="donate.php" class="btn" aria-label="Donate">Donate</a>
    <a href="policies.php" class="btn" aria-label="View Policies">Policies</a>
    <a href="candidates.php" class="btn" aria-label="View Candidates">Candidates</a>
</section>

<?php
// Include footer for consistent site navigation
require_once __DIR__.'/includes/footer.php';
