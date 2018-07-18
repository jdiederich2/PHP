<!DOCTYPE html>
<html>
    <head>
        <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Ascii Table Generator</title>
        
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body>
        <?php
        $myForm = <<<FORMSTUFF

        <h3>Generate ASCII Table</h3>
        
        <form action="$_SERVER[PHP_SELF]" method="post">
            
            <label>Number of rows:</label>
            <input type="text" name="numRows" id="numRows" value="32">
            <br><br>
            <input type="submit" name="go" value="Create ASCII Table">

        </form>
                
FORMSTUFF;

        if(!isset($_POST['go'])) {
        print $myForm;
        
        } else {
            
            if(isset($_POST['numRows'])) {
            $numRows = (int)($_POST['numRows']);
            
            } else {
                $numRows = "";
            }
            
            $endAscii = 256;
            
            $numColumns = floor($endAscii / $numRows);
            
            if ($endAscii % $numRows) {
                $numColumns++;
            }
            
            //print "<h3>Number of columns = $numColumns</h3>";
            
            // Generate table
            ?>
        <table>
            
            <?php
            // for each column, display two <th> cells
            for ($cols = 0; $cols < $numColumns; $cols++) {
                ?>
                <th class="num">ASCII</th>
                <th class="chr">CHR</th>
                <?php
            }
            ?>
            </tr>
            
            <?php
            
            // produce the remaining rows in the table
            //
            // outer loop for rows
            for ($rows = 0; $rows < $numRows; $rows++) {


            ?>
            <tr>
            
            <?php
                // generate columns (<td>'s) for this row
                // using an inner for loop
                for ($cols = 0; $cols < $numColumns; $cols++) {
                    $asciiNum = $cols  * $numRows + $rows;
                    
                    
                    if ($asciiNum < $endAscii) {
                ?>
                
                
                <td class="num"><?= $asciiNum ?></td>
                <td class="chr"><?= chr($asciiNum) ?></td>
                
                <?php
                    }
                    
                }  // for each logical column
            
            ?>
            </tr>
            <?php
                
            }  // for each table row
            
            
            ?>
        </table>
        <?php
           
            echo $myForm;
        }
         
        ?>
    </body>
</html>

