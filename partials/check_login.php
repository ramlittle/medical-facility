<?php
    if (!isset($_SESSION['user'])) {
        // User is not logged in, redirect to the login page
        header("Location: ../pages/login.php");
        exit(); // Ensure that no further code execution happens after redirection
    }
    $user=$_SESSION['user'];
?>