<?php
session_start();

// User session data to check if a user is authenticated 
// If not we will redirect them to our login page.
require 'authenticate.php';

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Books CMS Admin Page</title>
    </head>
    <body>
    
        <h2>Books Site Content Management System</h2>
        
        <ul>
            <li><a href="booksAdmin.php">Manage Books</a></li>
            <li><a href="authorsAdmin.php">Manage Authors</a></li>
        </ul>
        
        <a href="login.php?logOut=1">Log Out</a>
    </body>
</html>
