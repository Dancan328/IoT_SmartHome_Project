<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to the signin page after logout
header("Location: ../pages/signin.php");
exit;
?>
