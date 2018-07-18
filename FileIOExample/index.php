<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>File IO Example in PHP</title>
        
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body>
        
    <?php
        if (isset($_POST['submit'])) {
            
            // open a connection to the file to append data to it
            $fp = fopen("assets/stateInfo.txt", 'a');
            
            $outputLine = "";
            
            foreach ($_POST as $field) {
                
                if ($field != $_POST['submit']) {
                    $outputLine .= $field . ':';
                }
                
            }
            
            // remove the trailing ":" from end of $outputLine string
            $outputLine = rtrim($outputLine, ':');
            
            // write $outputLine to the end of our file
            fwrite($fp, $outputLine . PHP_EOL);  // Could use fputs instead
            
            fclose($fp);
            
            // Next, we want to reopen the file in read only mode to
            // read the files data and display it in a table
            $fp = fopen("assets/stateInfo.txt", 'r');
            
            // jump out of php and display the beginning of the table
            
            ?>
        
        <table>
            <tr>
                <th>State Name</th>
                <th>State Bird</th>
                <th>State Animal</th>
                <th>State Motto</th>
            </tr>
            
            <?php
            
            // Read all lines in our input file and echo them as cells in
            // our table
            // While not EOF, read next line
            while (!feof($fp)) {
                
                // read the next line pointed to by our file pointer
                // String we get back will have the new line character
                $line = rtrim(fgets($fp));
                
                // check if line of data that was read is valid
                // (i.e. not a blank line)
               if ($line != "") {
                    
                    // Sanity check
                    // echo "<h3>\$line contains $line</h3>";
                   
                   // Break up the line that we read into its individual
                   // fields and store the values from 
                   // left to right into descriptive variable names
                   // via a list literal.
                   list($stateName, $stateBird, $stateAnimal, $stateMotto) = explode(":", $line);
                   
                   ?>
            <tr>
                <td><?php echo $stateName ?></td>
                <td><?php echo $stateBird ?></td>
                <td><?php echo $stateAnimal ?></td>
                <td><?= $stateMotto ?></td>  <!--  Shortcut code for echo -->
            </tr>
<?php
            
               }
                
            }
            
            ?>
        </table>
        
<?php
                    
        } else { // Form has not been submitted
            
        ?>
        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

           <label for="stateName">State Name:</label>
           <input type="text" name="stateName" id="stateName" value="">
           <br><br>

           <label for="stateBird">State Bird:</label>
           <input type="text" name="stateBird" id="stateBird">
           <br><br>
            
           <label for="stateAnimal">State Animal:</label>
           <input type="text" name="stateAnimal" id="stateAnimal">
           <br><br>
           
           <label for="stateMotto">State Motto:</label>
           <textarea name="stateMotto" id="stateMotto"></textarea>
           <br><br>

           <input type="submit" name="submit" value="Go">
          
        </form>
        <?php
        }
        ?>
    </body>
</html>
