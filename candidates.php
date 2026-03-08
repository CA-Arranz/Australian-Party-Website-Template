
<?php
// candidates.php
// Displays a list of candidate profiles for the party, including photo, name, electorate, biography, and social links.
// Includes header and footer for consistent layout.
require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/db.php';

// Fetch all candidates from the database
$stmt = $pdo->query('SELECT * FROM candidates');
$candidates = $stmt->fetchAll();
?>

<section aria-label="Candidates" tabindex="0">
    <h2>Candidate Profiles</h2>
    <ul aria-label="Candidate List">
        <?php foreach ($candidates as $candidate): ?>
            <li>
                <!-- Candidate photo, if available -->
                <?php if ($candidate['photo']): ?>
                    <img src="<?= htmlspecialchars($candidate['photo']) ?>" alt="Photo of <?= htmlspecialchars($candidate['name']) ?>" style="max-width:120px;">
                <?php endif; ?>
                <!-- Candidate name -->
                <h3><?= htmlspecialchars($candidate['name']) ?></h3>
                <!-- Candidate electorate -->
                <strong>Electorate:</strong> <?= htmlspecialchars($candidate['electorate']) ?><br>
                <!-- Candidate biography -->
                <div><?= nl2br(htmlspecialchars($candidate['biography'])) ?></div>
                <!-- Candidate social links, if available -->
                <?php if ($candidate['social_links']): ?>
                    <div>Social: <?= htmlspecialchars($candidate['social_links']) ?></div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php
// Include footer for consistent site navigation
require_once __DIR__.'/includes/footer.php';
