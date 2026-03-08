
<?php
// admin/index.php
// Admin dashboard page. Requires authentication and provides links to admin features.
session_start();
require_once '../includes/auth.php';
require_login(); // Redirects to login if not authenticated
require_once '../includes/header.php';
?>

<div class="container">
    <h2>Admin Dashboard</h2>
    <!-- Admin feature links -->
    <ul>
        <li><a href="party-registration.php">Party Registration Application Form</a></li>
        <li><a href="compliance-checklist.php">Party Registration Compliance Checklist</a></li>
        <!-- Add more admin links here -->
            <li><a href="compliance-report.php">Compliance Report (Downloadable)</a></li>
    </ul>
</div>

<?php
// Include footer for consistent site navigation
require_once '../includes/footer.php';
?>
