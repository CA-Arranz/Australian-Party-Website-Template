
<?php
// admin/party-registration.php
// Party Registration Application Form (Compliance-driven)
// Displays a form for registering a political party in Victoria, referencing VEC requirements.
// References: docs/Registration of political parties applicants handbook.md

require_once '../includes/header.php';
require_once '../includes/db.php';

// Compliance checklist items (from handbook)
$requirements = [
    'Written constitution',
    'Registered officer information',
    'Deputy registered officer information',
    'Minimum 500 eligible members',
    'Membership list upload',
    'Party logo (optional)',
    'Application fee payment',
    'Statutory declaration',
    'Document uploads',
];

?>

<div class="container">
    <h2>Party Registration Application Form</h2>
    <!-- Form description referencing VEC handbook -->
    <p>This form is for registering a political party in Victoria. All requirements are defined by the Victorian Electoral Commission (<a href="/docs/Registration%20of%20political%20parties%20applicants%20handbook.md" target="_blank">see handbook</a>).</p>
    <form action="party-registration-submit.php" method="post" enctype="multipart/form-data">
        <!-- Party details section -->
        <fieldset>
            <legend>Party Details</legend>
            <label for="party_name">Party Name:</label>
            <input type="text" id="party_name" name="party_name" required><br>

            <label for="abbreviation">Abbreviation:</label>
            <input type="text" id="abbreviation" name="abbreviation"><br>

            <label for="constitution">Upload Written Constitution:</label>
            <input type="file" id="constitution" name="constitution" accept=".pdf,.doc,.docx" required><br>
        </fieldset>

        <!-- Registered officer section -->
        <fieldset>
            <legend>Registered Officer</legend>
            <label for="officer_name">Name:</label>
            <input type="text" id="officer_name" name="officer_name" required><br>
            <label for="officer_address">Address:</label>
            <input type="text" id="officer_address" name="officer_address" required><br>
            <label for="officer_email">Email:</label>
            <input type="email" id="officer_email" name="officer_email" required><br>
        </fieldset>

        <!-- Deputy registered officer section -->
        <fieldset>
            <legend>Deputy Registered Officer</legend>
            <label for="deputy_name">Name:</label>
            <input type="text" id="deputy_name" name="deputy_name" required><br>
            <label for="deputy_address">Address:</label>
            <input type="text" id="deputy_address" name="deputy_address" required><br>
            <label for="deputy_email">Email:</label>
            <input type="email" id="deputy_email" name="deputy_email" required><br>
        </fieldset>

        <!-- Membership section -->
        <fieldset>
            <legend>Membership</legend>
            <label for="membership_list">Upload Membership List (CSV):</label>
            <input type="file" id="membership_list" name="membership_list" accept=".csv" required><br>
            <small>Format must comply with handbook Appendix F.</small>
        </fieldset>

        <!-- Party logo section (optional) -->
        <fieldset>
            <legend>Party Logo (Optional)</legend>
            <label for="logo">Upload Party Logo:</label>
            <input type="file" id="logo" name="logo" accept=".png,.jpg,.jpeg"><br>
            <small>Logo requirements: see handbook Appendix D/E.</small>
        </fieldset>

        <!-- Statutory declaration section -->
        <fieldset>
            <legend>Statutory Declaration</legend>
            <label for="statutory_declaration">Upload Statutory Declaration:</label>
            <input type="file" id="statutory_declaration" name="statutory_declaration" accept=".pdf,.doc,.docx" required><br>
        </fieldset>

        <!-- Application fee section -->
        <fieldset>
            <legend>Application Fee</legend>
            <label for="fee_receipt">Upload Proof of Payment:</label>
            <input type="file" id="fee_receipt" name="fee_receipt" accept=".pdf,.jpg,.png" required><br>
        </fieldset>

        <!-- Compliance checklist section -->
        <fieldset>
            <legend>Compliance Checklist</legend>
            <ul>
                <?php foreach ($requirements as $item): ?>
                    <!-- Checklist item (disabled, checked for display) -->
                    <li><input type="checkbox" disabled checked> <?= htmlspecialchars($item) ?></li>
                <?php endforeach; ?>
            </ul>
            <small>All requirements must be met for successful registration. See <a href="/docs/Registration%20of%20political%20parties%20applicants%20handbook.md" target="_blank">VEC handbook</a>.</small>
        </fieldset>

        <button type="submit">Submit Application</button>
    </form>
</div>

<?php
// Include footer for consistent site navigation
require_once '../includes/footer.php';
?>
