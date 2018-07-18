<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Scratch PHP File - Basics</title>
    </head>
    <body>
       <?php
       
       // Variable Names can consist of letters, digits, and 
       // underscores, but they must begin with a letter or underscore.
       // Variable names are always prefixed with a $.
       $num = 3;
       
       print "I know $num programming languages, or is it \$Stuff " . ($num + 1);
       echo "<br>I know $num programming languages, or is it ", ($num +1);
       
       // Build a username for this customer based on the form data
       // they submit.
       //
       // The username should be he last name followed by the first character
       // of the first name followed by the larger of the two numbers. 
       // If the two numbers are equal, do not use the numbers.
       //
       
       // If first name text box has a non-null value, store it in $fName
       if(!empty($_POST['fName'])) {
           $fName = $_POST['fName'];
       } else {
           $fName = "Jon";
       }
       
        if(!empty($_POST['lName'])) {
           $lName = $_POST['lName'];
       } else {
           $lName = "Doe";
       }
       
        if(!empty($_POST['num1'])) {
           $firstNum = $_POST['num1'];
       } else {
           $firstNum = 0;
       }
       
       if(!empty($_POST['num2'])) {
           $secondNum = $_POST['num2'];
       } else {
           $secondNum = 0;
       }
       
       echo "<br><br>Hi $fName $lName *** $firstNum and $secondNum";
       
       if($firstNum < $secondNum) {
           $largest = $secondNum;
           $smallest = $firstNum;
       } elseif ($firstNum > $secondNum) {
           $largest = $firstNum;
           $smallest = $secondNum;
       } else {
           $largest = "";
           $smallest = 0;
       }
       
       // Build the username
       $userName = strtolower($lName . substr($fName, 0, 1) . $largest);
            
       echo "<h3>Hi $fName $lName!  Your new username is <span style=\"color: orange; background-color: navy;\">$userName</span></h3>\n";
        ?>
        
        <h3>Hi <?php echo "$fName $lName"?>!  Your new username is <span style="color: orange; background-color: navy;"><?=$userName?></span></h3>

        <ul>
<?php 
                // while loop example
                while ($smallest < $largest) {
?>
            <li><?= $smallest ?></li>
<?php
                    $smallest++;
            }
?>
        </ul>
        
        <br><br>
        
<?php

// for loop
print "\t\t";
for ($i = $largest; $i >= 0; $i--) {
    print "$i ";
}
    print " blast off... <br><br>\n\n"
?>
        
        <table border="1px" cellpadding="4px">
            
            <tr>
                <th>Form field name</th>
                <th>Form field value</th>
            </tr>
<?php
// 
// Use a foreach loop to step through the $_POST
// Associate array one element at a time displaying
// each element's key and value.
//
//
// Two varients of foreach syntax in php:
// 1) foreach ($arrayName as $valueVariable) {}
//      get me only the element values
//
// 2) foreach ($arrayName as $keyVariable => $valueVariable) {}
//      get both the key and the value for the element
//
    foreach ($_POST as $fieldName => $fieldValue) {
        // Print out table row using a Here Document
        print <<< TABLEROW
            <tr>
                <td>$fieldValue</td>
                <td>$fieldValue</td>
            </tr>
    
TABLEROW;
    
}
?>
            
        </table>
        
    </body>
</html>
