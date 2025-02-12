<?php // If session exists, redirect to dashboard
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
     if (isset($_SESSION['user'])) {
        header("Location: ./dashboard.php");
        exit();
    }
?>