
<?php
// admin/compliance-checklist.php
// Displays a compliance checklist for party registration based on VEC requirements.
// References: docs/Registration of political parties applicants handbook.md

require_once '../includes/header.php';

// Checklist items required for party registration
$checklist = [
    'Written constitution uploaded',
    'Registered officer details provided',
    'Deputy registered officer details provided',
    'Minimum 500 eligible members (CSV uploaded)',
    'Membership list format complies with Appendix F',
    'Party logo uploaded (optional, complies with Appendix D/E)',
    'Statutory declaration uploaded',
    'Proof of application fee payment uploaded',
    'All documents meet VEC requirements',
    'Application form completed and submitted',
    'Notification to members (if required)',
    'Initial meeting with VEC scheduled',
    'Publication of notice of application',
    'Objection requirements checked',
    'Post-registration responsibilities reviewed',
];
?>

<div class="container">
    <h2>Party Registration Compliance Checklist</h2>
    <!-- Checklist description -->
    <p>This checklist is based on the Victorian Electoral Commission handbook. All items must be completed for successful registration.</p>
    <ul>
        <?php foreach ($checklist as $item): ?>
            <!-- Checklist item (disabled checkbox for display) -->
            <li><input type="checkbox" disabled> <?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
    </ul>
    <!-- Reference link to handbook -->
    <small>Reference: <a href="/docs/Registration%20of%20political%20parties%20applicants%20handbook.md" target="_blank">VEC Registration Handbook</a></small>
</div>

<?php
// Include footer for consistent site navigation
require_once '../includes/footer.php';
?>
