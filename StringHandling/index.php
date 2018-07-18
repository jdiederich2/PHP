<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>String Handling functions in PHP</title>
    </head>
    <body>
        <?php
        
        $str1 = "php";
        $str2 = "your visual blueprint for web development";
        $str3 = "Washington";
        $str4 = "Washin";
        
        // String handling functions related to case...
        echo "<h3>$str1, " . ucfirst($str1) . ", " . strtoupper($str1) . ", ";
        echo ucwords($str2) . "</h3>\n\n";
        
        
        // String length an dstring comparison
        
        echo "<h3>The length of $str3 is ", strlen($str3), " characters</h3>\n";
        
        echo "<h3>The length of 1234.56 is ", strlen(1234.56), " characters</h3>\n";
        
        echo "<h3>The length of \tGreen Bay Packers is ", strlen("\tGreen Bay Packers"), " characters</h3>\n";
        
        echo "<h3>The length of \tGreen Bay Packers is ", strlen('\tGreen Bay Packers'), " characters</h3>\n";
        
        $result = strcmp($str1, $str3);
        
        echo "<h3>String comparision return value for $str1 vs $str3 is $result<h3>\n";
        
        $result = strcmp($str3, $str4);
        
        echo "<h3>String comparision return value for $str3 vs $str4 is $result<h3>\n";
        
        $result = strcmp($str3, $str3);
        
        echo "<h3>String comparision return value for $str3 vs $str3 is $result<h3>\n";
        
        
        // Substrings - portions of strings
        echo "<h3>", substr($str3, 0), "</h3>\n";
        echo "<h3>", substr($str3, 0, 4), "</h3>\n";
        echo "<h3>", substr($str3, -3), "</h3>\n";
        
        $greeting = "good morning citizen";
        
        // replace "morning" with "bye"
        $farewell = substr_replace($greeting, "bye", 4, 8);
        echo "<h3>\$farewell is now <span style=\"color:green\">$farewell</span></h3>\n";
        
        // insert "kind " before "citizen"
        $farewell = substr_replace($farewell, "kind ", 8, 0);
        echo "<h3>\$farewell is now <span style=\"color:green\">$farewell</span></h3>\n";
        
        // delete everything following "goodbye"
        $farewell = substr_replace($farewell, "", 7);
        echo "<h3>\$farewell is now <span style=\"color:green\">$farewell</span></h3>\n";
 
        // intert "now it's time to say " at the beginning of the string
        $farewell = substr_replace($farewell, "it's time to say ", 0, 0);
        echo "<h3>\$farewell is now <span style=\"color:green\">$farewell</span></h3>\n";
        
        // replace "bye" with "riddance" starting from the entd of the string
        $farewell = substr_replace($farewell, " riddance", -3);
        echo "<h3>\$farewell is now <span style=\"color:green\">$farewell</span></h3>\n";
        
        // delete "rid" from the string starting from the end
        $farewell = substr_replace($farewell, "", -8, 3);
        echo "<h3>\$farewell is now <span style=\"color:green\">$farewell</span></h3>\n";
        
        ?>
    </body>
</html>
