<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Billy Bob's Carpet Warehouse</title>
        
        <link href='css/styles.css' rel='stylesheet'>
    </head>
    <body>
  
      <?php

       // phpinfo();
        
       // Determine if the form has been submitted
       // 
        if (isset($_POST['submit'])) {
            
            // Set up an associative array containing the carpet types as
            // its keys and price per square foot as its values
            $carpetPrices = array("Berber" => 5.99, "Shag" => 3.25, "Astroturf" => 9.25, "Plush" => 1.50, "Commercial" => 2.00, "Loop Pile" => 2.50, "Rug" => 4.00);
            
            // Greet the user
            echo "<h3>Welcome to Billy Bob's Carpet Warehouse $_POST[fName] $_POST[lName]!</h3>\n";
            
            // Determine the square footage of the room to be carpeted...
            // Funcation Call..
            
            $area = squareArea($_POST['length'], $_POST['width']);
            // Next... create function... down under if statement
            
            echo "For a room of $_POST[length] feet by $_POST[width] feet, we have a square footage value of $area<br><br>";
            
            // Determine the cost of carpeting the user's room for each 
            // chosen carpet type.  Display the info for each chosen carpeting
            // as a bulleeted list item.
            // Function call...
            calculateCost($area, $_POST['carpetChoices'], $carpetPrices); // referencing the carpetChoices in form,,, do not use brackets here.
            // Need to create the function
            
        }
        
// ----------------------------------------------------------------------------------------------------------//  
        // FUNCTION AREA //
// __________________________________________________________________________________________________________ //        
        
        
        //
        // Define function squareArea
        //
        function squareArea($roomLength, $roomWidth) {
            return $roomLength * $roomWidth;
        }
        
        //
        // The calculateCost function determines and displays
        // the cost of the selected carpet types for the room area.
        //  $sqArea is passed in $Area parameter.... same as the other 3
        function calculateCost($sqArea, $selectedCarpets, $prices) {
            
            $total = 0;
            
            echo "<ul>\n";
            
            // for each carpet choice in $selectedCarpts, we want to 
            // determine the cost for carpeting the user's room and 
            // display the estimate for each carpet type chosen in a 
            // bulleted list.
            
            foreach ($selectedCarpets as $carpetType) {
                
                // Determine the cost for this type of carpeting
                $cost = $prices[$carpetType] * $sqArea;
                
                // Add this cost to the total cost.  We want a running total
                $total += $cost;
                
                echo "\t<li>At $" . number_format($prices[$carpetType], 2) . " per square foot of $carpetType carpeting, your cost will be $" . number_format($cost, 2) . "</li>\n" ;

                
            }
            
            
            echo "</ul>\n";
            
            echo "<br>For a grand total of: $" . number_format($total, 2) . "\n";
            
        }
        
       
        ?>
        
        <h2>Welcome to Billy Bob's Carpet Warehouse</h2>
        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

            <label for="fName">First Name:</label>
            <input type="text" name="fName" id="fName" value="">
             <br><br>

            <label for="lName">Last Name:</label>
            <input type="text" name="lName" id="lName">
             <br><br>

            <label for="length">Enter length of room (in feet):</label>
            <input type="text" name="length" id="length">
             <br><br>

            <label for="width">Enter width of room (in feet):</label>
            <input type="text" name="width" id="width">
             <br><br>

            <label for="carpetChoices">Carpet choices:</label>
	    <br>
            <select name="carpetChoices[]" id="carpetChoices" multiple size="5">

                <option value="Berber" selected="yes">Berber</option>
                <option value="Shag">Shag</option>
                <option value="Astroturf">Astroturf</option>
                <option value="Plush">Plush</option>
                <option value="Commercial">Commercial</option>
                <option value="Loop Pile">Loop Pile</option>
                <option value="Rug">Rug</option>

           </select>
           <br><br>

           <input type="submit" name="submit" value="Calculate Area">
          
        </form>
    </body>
</html>
