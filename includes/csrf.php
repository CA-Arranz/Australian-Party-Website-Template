
<?php
// csrf.php
// CSRF token generation and validation functions for form security.

/**
 * Generate or retrieve the current CSRF token for the session.
 * Creates a new token if not already set.
 * Returns the token string.
 */
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate a submitted CSRF token against the session token.
 * Returns true if valid, false otherwise.
 */
function csrf_check($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Output a hidden input field containing the CSRF token for use in forms.
 * Returns HTML string for the input.
 */
function csrf_input() {
    return '<input type="hidden" name="csrf_token" value="'.htmlspecialchars(csrf_token()).'">';
}
