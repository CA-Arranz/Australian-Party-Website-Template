
<?php
// header.php
// Shared header include for all pages. Sets up site navigation, loads config, and applies global styles.
require_once __DIR__.'/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Site title from config -->
    <title><?= htmlspecialchars($SITE_NAME) ?></title>
    <!-- Global stylesheet -->
    <link rel="stylesheet" href="/Australian-Party-Website-Template/assets/css/style.css">
</head>
<body>
<!-- Skip to content link for accessibility -->
<a href="#main-content" class="skip-link" tabindex="0">Skip to main content</a>
<!-- Site header and navigation -->
<header role="banner" aria-label="Site Header">
    <nav aria-label="Main Navigation" role="navigation">
        <ul class="nav" role="menubar">
            <li class="site-logo"><a href="/Australian-Party-Website-Template/index.php" aria-label="Home" role="menuitem"><!-- You can replace this text with an <img> for a logo -->
                <?= htmlspecialchars($SITE_NAME) ?>
            </a></li>
            <li class="nav-list-item"><a href="/Australian-Party-Website-Template/about.php" class="nav-link" role="menuitem">About</a></li>
            <li class="nav-list-item"><a href="/Australian-Party-Website-Template/policies.php" class="nav-link" role="menuitem">Policies</a></li>
            <li class="nav-list-item"><a href="/Australian-Party-Website-Template/candidates.php" class="nav-link" role="menuitem">Candidates</a></li>
            <li class="nav-list-item"><a href="/Australian-Party-Website-Template/news.php" class="nav-link" role="menuitem">News</a></li>
            <li class="nav-list-item"><a href="/Australian-Party-Website-Template/events.php" class="nav-link" role="menuitem">Events</a></li>
            <li class="nav-list-item"><a href="/Australian-Party-Website-Template/volunteer.php" class="nav-link" role="menuitem">Volunteer</a></li>
            <li class="nav-list-item"><a href="/Australian-Party-Website-Template/donate.php" class="nav-link" role="menuitem">Donate</a></li>
            <li class="nav-list-item"><a href="/Australian-Party-Website-Template/contact.php" class="nav-link" role="menuitem">Contact</a></li>
            <li class="nav-list-item"><a href="/Australian-Party-Website-Template/transparency.php" class="nav-link" role="menuitem">Transparency</a></li>
            <?php
            require_once __DIR__.'/auth.php';
            if (is_logged_in() && in_array(current_user_role(), ['admin', 'webmaster'])): ?>
                <li class="nav-list-item"><a href="/Australian-Party-Website-Template/admin/index.php" class="nav-link" role="menuitem">Admin</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<!-- Main content area -->
<main id="main-content" tabindex="-1">
