<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Printers Generator - Oh, oh, oh, its magic...</title>
        
        <link href="css/printersGen.css" rel="stylesheet">
    </head>
    <body>
        <?php
        
        // Initialize array variables
        $ipAddresses = array();
        $printerType = array();
        $buildings = array();
        $roomNumbers = array();
        $buildingNumPrinters = array();
        
        // open the input file for reading
        $fp = fopen('printers.txt', 'r');
        
        // read the file one line at a time - while not EOF
        while(!feof($fp)) {
            
            $printerLine = rtrim(fgets($fp));
            
            if ($printerLine != "") {
                
                // Break up line of data into field values
                list($ipAddress, $hostName, $pType, $buildingName, $roomNumber) = explode(',', $printerLine);
                
                // Let's use the arrays we set up eariler to 
                // store the data from each input line so we can
                // access the data easier later...
                // 
                // These will be 
                // associative arrays with the host name as the key
                // into our first 4 arrays
                // indexed arrays - arrays that have the exact same elements, but more than two or more arrays
                // relate the value of the elements to each other using a common key.
                
                // Other way would be a multi-dimensional array
                
                $ipAddresses[$hostName] = $ipAddress;
                $printerType[$hostName] = $pType;
                $buildings[$hostName] = $buildingName;
                $roomNumbers[$hostName] = $roomNumber;
               
                // Also, store the building names uniquely as keys in
                // $buildingNumPrinters array where the value
                // of each element will represent the number of printers in 
                // that building.
                if (!isset($buildingNumPrinters[$buildingName])){
                    
                    $buildingNumPrinters[$buildingName] = 0;
                }
      
                $buildingNumPrinters[$buildingName] ++;
                
            }  // end if read line was valid
            
        }  // end while not EOF
          
        // Ok. we've finished reading our input data and we have stored all
        // of the data in associative arrays so lets start our output.
        //
        // FOr each building, produce a table showing the number of printers in the
        // building and produce a table row per printer in that building. Each 
        // row will show the printers information in its cells.
        foreach ($buildingNumPrinters as $building => $numPrinters) {
            
            ?>
        <table>
            <tr class="firstRow">
                <td colspan="3">
                    <span class="headerTxt"><?= $building ?></span>
                </td>
                <td>
                    # of printers = <?= $numPrinters ?></td>
            </tr>
            <?php
            
            // for each printer in this building, produce a row
            // in this buildings table
            foreach ($ipAddresses as $printerName => $ipAddr) {
                
                // Create a table row for this printer only if it
                // is in the building this table is being built for.
                if($building == $buildings[$printerName]) {
                    
                    // Add this printer as a row in this table
                    // and color code its cell's background based on the 
                    // type of printer it is.
                    if ($printerType[$printerName] == 'Lexmark') {
                        $className = 'lexmark';
                    } elseif ($printerType[$printerName] == 'HP LaserJet') {
                        $className = 'laserJet';
                    } elseif ($printerType[$printerName] == 'Epson') {
                        $className = 'epson'; 
                    } else {
                        $className = 'other';
                    }
                    
                    ?>
            
            <tr>
                <td class="<?= $className ?>"><?= $printerName ?></td>
                <td><?= $ipAddr ?></td>
                <td><?= $printerType[$printerName] ?></td>
                <td><?= $roomNumbers[$printerName] ?></td>
            </tr>
            
            <?php
                    
                }  // end if current table's building matches printer's building
                
            }  // end foreach printer
            
            ?>
        </table>
        <?php
        }  // end foreach building
        
        
        ?>
    </body>
</html>
