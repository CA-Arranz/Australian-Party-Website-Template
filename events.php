
<?php
// events.php
// Displays a list of campaign events and allows users to RSVP for each event.
// Handles RSVP form submission, CSRF protection, and stores RSVP details in the database.
// Includes header and footer for consistent layout.
require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/includes/db.php';

// Fetch all events from the database, ordered by date
$stmt = $pdo->query('SELECT * FROM events ORDER BY date ASC');
$events = $stmt->fetchAll();
?>

<section aria-label="Events" tabindex="0">
    <h2>Events</h2>
    <ul aria-label="Event List">
        <?php foreach ($events as $event): ?>
            <li>
                <!-- Event title -->
                <h3><?= htmlspecialchars($event['title']) ?></h3>
                <!-- Event description -->
                <div><?= nl2br(htmlspecialchars($event['description'])) ?></div>
                <!-- Event date and location -->
                <strong>Date:</strong> <?= htmlspecialchars($event['date']) ?><br>
                <strong>Location:</strong> <?= htmlspecialchars($event['location']) ?><br>
                <!-- Event map link, if available -->
                <?php if ($event['map_link']): ?>
                    <a href="<?= htmlspecialchars($event['map_link']) ?>" target="_blank" rel="noopener" aria-label="View map">View Map</a><br>
                <?php endif; ?>
                <!-- RSVP form for this event -->
                <form method="post" action="events.php" aria-label="RSVP Form">
                    <?php require_once __DIR__.'/includes/csrf.php'; echo csrf_input(); ?>
                    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                    <label for="name-<?= $event['id'] ?>">Name:</label>
                    <input type="text" id="name-<?= $event['id'] ?>" name="name" required>
                    <label for="email-<?= $event['id'] ?>">Email:</label>
                    <input type="email" id="email-<?= $event['id'] ?>" name="email" required>
                    <label for="phone-<?= $event['id'] ?>">Phone:</label>
                    <input type="text" id="phone-<?= $event['id'] ?>" name="phone">
                    <button type="submit" class="btn">RSVP</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php
    // Handle RSVP form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'], $_POST['name'], $_POST['email'], $_POST['csrf_token'])) {
        require_once __DIR__.'/includes/csrf.php';
        // Validate CSRF token
        if (csrf_check($_POST['csrf_token'])) {
            // Store RSVP details in the database
            $stmt = $pdo->prepare('INSERT INTO event_rsvps (event_id, name, email, phone) VALUES (?, ?, ?, ?)');
            $stmt->execute([
                intval($_POST['event_id']),
                htmlspecialchars($_POST['name']),
                htmlspecialchars($_POST['email']),
                htmlspecialchars($_POST['phone'])
            ]);
            echo '<p>RSVP submitted successfully.</p>';
        } else {
            // CSRF token invalid
            echo '<p>Invalid CSRF token.</p>';
        }
    }
    ?>
</section>

<?php
// Include footer for consistent site navigation
require_once __DIR__.'/includes/footer.php';
