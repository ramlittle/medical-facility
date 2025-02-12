<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Redirect to login if session is inactive
    if (!isset($_SESSION['user'])) {
        header("Location: ../pages/login.php");
        exit();
    }
    $user = $_SESSION['user'];
?>