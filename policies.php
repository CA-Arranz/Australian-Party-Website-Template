<?php
// Include header and database connection
require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/db.php';

// Get selected category from query string
$category = $_GET['category'] ?? '';

// Build SQL query for policies
$sql = 'SELECT * FROM policies';
$params = [];
if ($category) {
    $sql .= ' WHERE category = ?';
    $params[] = $category;
}

// Prepare and execute SQL statement
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$policies = $stmt->fetchAll();
?>

<section aria-label="Policies" tabindex="0">
    <h2>Policies</h2>
    <!-- Policy category filter form -->
    <form method="get" action="policies.php" aria-label="Policy Category Filter">
        <label for="category">Filter by Category:</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="">All</option>
            <option value="economy">Economy</option>
            <option value="environment">Environment</option>
            <option value="health">Health</option>
            <option value="education">Education</option>
            <option value="technology">Technology</option>
            <option value="national security">National Security</option>
        </select>
    </form>

    <!-- Policy list -->
    <ul aria-label="Policy List">
        <?php foreach ($policies as $policy): ?>
            <li>
                <h3><?= htmlspecialchars($policy['title']) ?></h3>
                <strong>Category:</strong> <?= htmlspecialchars($policy['category']) ?><br>
                <div><?= nl2br(htmlspecialchars($policy['content'])) ?></div>
                <small>Published: <?= htmlspecialchars($policy['published_at']) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php
// Include footer
require_once __DIR__.'/includes/footer.php';
