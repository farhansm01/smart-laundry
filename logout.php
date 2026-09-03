<?php
session_start();

// Unset all session variables and destroy session
session_unset();
session_destroy();

// Clear remember me cookie if set
if (isset($_COOKIE["username"])) {
    setcookie("username", "", time() - 3600, "/");
}

// Immediately redirect to Home Page (index.php)
header("Location: index.php");
exit();
?>
