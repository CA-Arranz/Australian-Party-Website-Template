<?php
// admin/webmaster-logout.php
// Webmaster logout handler
session_start();
session_destroy();
header('Location: webmaster-login.php');
exit;
