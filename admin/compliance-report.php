<?php
// admin/compliance-report.php
// Generates and displays downloadable compliance reports for party registration and audit logs.
// References: docs/Registration of political parties applicants handbook.md

session_start();
require_once '../includes/auth.php';
require_login(); // Redirects to login if not authenticated
require_once '../includes/header.php';
require_once '../includes/db.php';

// Fetch party registration status (dummy example, adapt as needed)
$partyStmt = $pdo->query('SELECT * FROM party_registration ORDER BY submitted_at DESC LIMIT 1');
$party = $partyStmt->fetch();

// Fetch audit logs
$auditStmt = $pdo->query('SELECT user_id, action, ip_address, timestamp FROM audit_logs ORDER BY timestamp DESC LIMIT 100');
$auditLogs = $auditStmt->fetchAll();

?>
<div class="container">
    <h2>Compliance Report</h2>
    <p>This report summarizes party registration status and recent audit logs for compliance review. Download as CSV for VEC or internal records.</p>

    <h3>Party Registration Status</h3>
    <?php if ($party): ?>
        <ul>
            <li>Party Name: <?= htmlspecialchars($party['party_name']) ?></li>
            <li>Submitted At: <?= htmlspecialchars($party['submitted_at']) ?></li>
            <li>Status: <?= htmlspecialchars($party['status']) ?></li>
            <!-- Add more fields as needed -->
        </ul>
    <?php else: ?>
        <p>No registration data found.</p>
    <?php endif; ?>

    <h3>Recent Audit Logs</h3>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Action</th>
                <th>IP Address</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($auditLogs as $log): ?>
                <tr>
                    <td><?= htmlspecialchars($log['user_id']) ?></td>
                    <td><?= htmlspecialchars($log['action']) ?></td>
                    <td><?= htmlspecialchars($log['ip_address']) ?></td>
                    <td><?= htmlspecialchars($log['timestamp']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form action="download-compliance-report.php" method="post">
        <button type="submit">Download Compliance Report (CSV)</button>
    </form>
</div>

<?php
require_once '../includes/footer.php';
?>
