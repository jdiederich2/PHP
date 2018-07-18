<?php

if (!session_id()) {
    session_start();
}

// Save any value in $_GET['url'] that was passed into this file 
// in a session variable named targetURL
if (isset($_GET['url'])) {
    // persist the passed-in url that came from authenticat.php
    $_SESSION['targetURL'] = $_GET['ur'];
} else {
    // nothing was passed in $_GET['url'}
    $_SESSION['targetURL'] = "/BooklisterCMS/adminPage.php";
}


// If login form has been submitted, try to authenticate 
// the user based on our DB users table.
if (isset($_POST['clickIt'])) {
    
    // FOrm will not display as authenticated would be valid so we redirect
    // Process the form data
    // Aquire the username and password from the form
    $uName = trim(strip_tags($_POST['userName']));
    $pWord = trim(strip_tags($_POST['passWord']));
    
    if ($uName == "" | $pWord == "") {
        echo "<h3 style=\"color:red\">Please enter both a user name and password></h3>\n";
    } else {  // both were enter, so check them
        
        require 'dbConnect.php';
        
        // Query our users table and see if we have an account match
        try{
            
            $sql = "SELECT pWord FROM users
                WHERE uName='$uName'";
            
            $password = $pdo->query($sql)->fetchColumn();
            
        } catch (PDOException $ex) {
             $error = 'Error fetching user account info: ' . $ex->getMessage();
                    include 'error.html.php';
                    exit();
        }
    }
    
} else {  // Form was not submitted
    
    // Check to see if user wishes to log out...
    // Form will also display
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BookLister CMS Admin Login Page</title>
    </head>
    <body>
        <h2 id="myh2">Please login to gain administrative access</h2>
        
        <form action="" method="post">
            <label for="userName">Username:</label>
            <input type="text" placeholder="Username" name="userName" id="userName">
            
            <br><br>
            
            <label for="userName">Password:</label>
            <input type="password" placeholder="Password" name="passWord" id="passWord">
             
            <br><br>
            
            <input type="submit" name="clickIt" value="Log In">
        </form>
    </body>
</html>
