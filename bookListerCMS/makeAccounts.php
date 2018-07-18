<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create CMS Admin Accounts</title>
    </head>
    <body>
        <?php
        // Connect to DB server and select the webooks DB
        require 'dbConnect.php';
        
        // Drop any existing users table
        try {
            $pdo->exec("DROP TABLE if exists users");
        } catch (PDOException $ex) {
            $error = 'Could not drop table: ' . $ex->getMessage();
            include 'error.html.php';
        }
        
        //
        // (Re) create the users table
        //
        try {
            $sql = "CREATE TABLE users
                (
                uName varchar(255) primary key,
                pWord varchar(255) 
                )";
            $pdo->exec($sql);
        } catch (PDOException $ex) {
            $error = 'Could not create table: ' . $ex->getMessage();
            include 'error.html.php';
            exit();
        }
        
        
        // Get user information from ids_fa2017.txt and insert
        // generated account information into users table.
        //
        $fp = fopen('ids_fa2017.txt', "r");
        
        while (!feof($fp)) {
            
            // Read the next line
            $userName = strtolower(trim(fgets($fp, 255)));
            
            if ($userName != "") {
                
                // Break up line into fields
                list($fName, $lName) = explode(" ", $userName);
                
                // Construct the username and password
                //
                // first character of the first name followed
                // by the last name
                $userName = substr($fName, 0, 1) . $lName;
                
                
                // First 4 characters of last name if present,
                // followed by length of last name, followed 
                // by the first name with uppercase first letter.
                $pWord = substr($lName, 0, 4) . strlen($lName) . ucfirst($fName);
                
                $md5password = md5($pWord);
                $sh1password = sha1($pWord);
                $hashedPassword = password_hash($pWord, PASSWORD_DEFAULT);
                $anotherHashedPassword = password_hash($pWord, PASSWORD_DEFAULT);        
                
                echo "<h2 style=\"color: green\">Username: $userName <br> password: $pWord <br> md5: $md5password
                    <br> sh1: $sh1password <br> hashed: $hashedPassword <br> anotherHashed: $anotherHashedPassword <br></h2>";
                
                // Insert our account data into th eusers table
                try {
                    $sql = "INSERT INTO users
                        VALUES(:uName, :pWord)";
                    
                    $s = $pdo->prepare($sql);
                    
                    $s->bindValue(':uName', $userName);
                    $s->bindValue(':pWord', $hashedPassword);
                    
                    $s->execute();
                    echo "<h3 style=\"color:purple\">Your new user $userName has been added.</h3>\n";
                } catch (PDOException $ex) {
                    $error = 'Error performing insert user name: ' . $ex->getMessage();
                    include 'error.html.php';
                    exit();
                }
            }
        }
        ?>
    </body>
</html>
