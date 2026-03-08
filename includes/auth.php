
<?php
// auth.php
// Authentication and authorisation functions for the platform.
// Handles login, session management, access control, and user role retrieval.
require_once __DIR__.'/db.php';

/**
 * Attempt to log in a user with the provided username and password.
 * Sets session variables on success.
 * Returns true if login is successful, false otherwise.
 */
function login($username, $password) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT id, password_hash, role FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        return true;
    }
    return false;
}

/**
 * Check if a user is currently logged in.
 * Returns true if logged in, false otherwise.
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Require user to be logged in. Redirects to login page if not authenticated.
 */
function require_login() {
    if (!is_logged_in()) {
        header('Location: /full-political-campaign-platform/admin/login.php');
        exit;
    }
}

/**
 * Log out the current user by destroying the session.
 */
function logout() {
    session_destroy();
}

/**
 * Get the current user's role (e.g., admin, user).
 * Returns role string or null if not set.
 */
function current_user_role() {
    return $_SESSION['user_role'] ?? null;
}
