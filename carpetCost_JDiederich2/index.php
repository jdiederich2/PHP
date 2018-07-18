<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Billy Bob's Carpet Warehouse</title>
		
		<link href="resources/styles.css" rel="stylesheet">
    </head>
    <body>
        <?php
        
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