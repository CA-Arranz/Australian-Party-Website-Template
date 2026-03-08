
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
    <link rel="stylesheet" href="/full-political-campaign-platform/assets/css/style.css">
</head>
<body>
<!-- Site header and navigation -->
<header role="banner" aria-label="Site Header">
    <nav aria-label="Main Navigation">
        <ul class="nav">
            <!-- Navigation links to main site pages -->
            <li><a href="/full-political-campaign-platform/index.php">Home</a></li>
            <li><a href="/full-political-campaign-platform/about.php">About</a></li>
            <li><a href="/full-political-campaign-platform/policies.php">Policies</a></li>
            <li><a href="/full-political-campaign-platform/candidates.php">Candidates</a></li>
            <li><a href="/full-political-campaign-platform/news.php">News</a></li>
            <li><a href="/full-political-campaign-platform/events.php">Events</a></li>
            <li><a href="/full-political-campaign-platform/volunteer.php">Volunteer</a></li>
            <li><a href="/full-political-campaign-platform/donate.php">Donate</a></li>
            <li><a href="/full-political-campaign-platform/contact.php">Contact</a></li>
            <li><a href="/full-political-campaign-platform/transparency.php">Transparency</a></li>
            <li><a href="/full-political-campaign-platform/admin/index.php">Admin</a></li>
        </ul>
    </nav>
</header>
<!-- Main content area -->
<main id="main-content" tabindex="-1">
