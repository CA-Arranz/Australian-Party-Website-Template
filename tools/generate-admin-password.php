<?php
// tools/generate-admin-password.php
// Run this script to generate a password hash for manual admin creation.
$password = 'admin123'; // Change this to your desired password
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Password: $password\nHash: $hash\n";
?>
