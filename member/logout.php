<?php
// member/logout.php
// Logout for party members
session_start();
session_destroy();
header('Location: login.php');
exit;
