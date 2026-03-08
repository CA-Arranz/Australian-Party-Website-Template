
<?php
// config.php
// Campaign Control Platform configuration file.
// Sets database, site, session, and error reporting settings for the platform.

// Database settings
$DB_HOST = 'localhost'; // Database host
$DB_NAME = 'campaign_platform'; // Database name
$DB_USER = 'root'; // Database user
$DB_PASS = ''; // Database password

// Site settings
$SITE_NAME = 'Campaign Control Platform'; // Site name for display
$AUTHORISATION_STATEMENT = 'Authorised by [Name], [Campaign Name], [Address], Australia'; // Legal authorisation statement

// Session settings
ini_set('session.cookie_httponly', 1); // Prevent JavaScript access to session cookies
ini_set('session.use_strict_mode', 1); // Enforce strict session mode
session_start(); // Start session

// Error reporting
error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 0); // Hide errors from user-facing pages
