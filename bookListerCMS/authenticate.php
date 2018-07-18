<?php

// Ensures a session is started
if (!session_id()) {
    session_start();
}


// Check for user authentication.
// If user is not authenticated, redirect them to login page.
// authenticated is actually the variable, which currently doesn't exist. Need to assign a value to it.
if (!isset($_SESSION['authenticated'])) {
    
    // Redirect to login.php
    header("Location: http://local:9090/BooklisterCMS/login.php?url=" . urlencode($_SERVER['SCRIPT_NAME']));  

    // Could also do  header("Location: /BooklisterCMS/login.php");
    
}


