<?php
// Include header and database connection
require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/db.php';
?>

<section aria-label="Transparency" tabindex="0">
    <h2>Transparency</h2>
    <p>We are committed to full transparency in donations, compliance, and campaign activities. Below are our public disclosures and compliance reports.</p>

    <!-- Donations public disclosure list -->
    <h3>Donations (Public Disclosure)</h3>
    <ul aria-label="Donation List">
        <?php
        // Fetch public donations from the database
        $stmt = $pdo->query('SELECT donor_name, amount, date FROM donations WHERE public_disclosure = 1 ORDER BY date DESC');
        foreach ($stmt as $donation): ?>
            <li>
                <?= htmlspecialchars($donation['donor_name']) ?> donated $<?= htmlspecialchars($donation['amount']) ?> on <?= htmlspecialchars($donation['date']) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Compliance reports section -->
    <h3>Compliance Reports</h3>
    <p>Reports are available upon request and comply with Australian Electoral Commission requirements.</p>
</section>

<?php
// Include footer
require_once __DIR__.'/includes/footer.php';
