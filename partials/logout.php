<?php
// Unset all session variables
$_SESSION = array();

// If the session cookie exists, delete it
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to the login page (or any other page)
header("Location: ../index.php");
exit(); // Ensure no further code is executed after redirection
?>