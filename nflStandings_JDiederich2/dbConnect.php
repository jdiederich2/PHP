<?php

try {
    
    $host = 'localhost:3306';
    $dbName = 'nflstandings';
    $uName = 'root';
    $uPass = '';
    $chrset = 'utf8';
    
    $conStr = "mysql:host=$host;dbname=$dbName;charset=$chrset";
    $pdo = new PDO($conStr, $uName, $uPass);
    
    // Use the connection -> is the same as the (.) operator
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES $chrset");
    
    
    
} catch (PDOException $ex) {

    $error = 'Unable to connect to the database server<br><br>' . $ex->getMessage();
  
    include'error.html.php';
    exit();
    
}

