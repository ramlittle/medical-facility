<?php
    function checkActivePage($page) {
        $currentPage = basename($_SERVER['PHP_SELF'], ".php"); // Get the current file name without extension
        return $currentPage === $page ? 'text-decoration-underline' : '';
    }

?>