<?php

// 1.  Connect to our DB server
// 2.  Select our database
//
// Oh, and check for exceptions...
try {
    
    // Create a new instance of a PDO object
    // PDO Creates a connection to the database
    $pdo = new PDO('mysql:host=localhost:3306;dbname=webbooks', 'bookListerUser', 
            'myPassword');
    
    // Use the connection -> is the same as the (.) operator
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
    
    
    
} catch (PDOException $ex) {

    $error = 'Unable to connect to the database server<br><br>' . $ex->getMessage();
    
    // Need to do to close select tag incase of error as the program would exit.
    if($closeSelect) {
        echo "</select>";
        $closeSelect = false;
    }
    
    include'error.html.php';
    exit();
    
}

