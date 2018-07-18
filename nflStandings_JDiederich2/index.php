<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Jennifer Diederich</title>
        <link href="css/standings.css" rel="stylesheet">
    </head>
    <body>
        <table id="nflStandings">
            <caption>NFL Standings - 2017</caption>
        
                <?php

                        require 'dbConnect.php';
                        
                        function callQuery($pdo, $sql, $error) {
                
                            try {
                                return $pdo->query($sql);
                            } catch (PDOException $ex) {
                                $error .= $ex->getMessage();
                                include 'error.html.php';
                                exit();
                            }
                        }
                        
          
                    $sql = "SELECT * FROM confnames";
                    $error = 'Error retrieving conference names';

                    $conferenceResults = callQuery($pdo, $sql, $error);
                    
                    while ($conferenceInfo = $conferenceResults->fetch()) {

                        $confId = $conferenceInfo['confId'];
                        $confAcronym = $conferenceInfo['confAcronym'];
                        $confName = $conferenceInfo['confName'];
                        
                ?>                    
            <thead>
                <tr>
                    <th class="spanCol" colspan="13"><?=$confName?></th>
                </tr>
            </thead>
            <?php
            
            
                                        
                  
                  
                    

                        $divSQL = "SELECT * FROM divnames ORDER BY divId";
                        $error = 'Error retrieving division names';

                        $divisionResults = callQuery($pdo, $divSQL, $error);

                        while ($divInfo = $divisionResults->fetch()) {


                            ?>

                    <thead class="divisionHead">
                    <tr>
                        <th class="division"><?=$divInfo['divName']?></th>
                        <th>W</th>
                        <th>L</th>
                        <th>T</th>
                        <th>PCT</th>
                        <th>HOME</th>
                        <th>ROAD</th>
                        <th>DIV</th>
                        <th>CONF</th>
                        <th>PF</th>
                        <th>PA</th>
                        <th>DIFF</th>
                        <th>STRK</th>
                    </tr>
                </thead>
 
                <?php
                
                $sql = "SELECT * FROM teaminfo, divnames WHERE teaminfo.conferenceId = $confId AND teaminfo.divisionId = divnames.divId ORDER BY teaminfo.wins DESC, teaminfo.teamName ASC";
                    $error = 'Error retrieving division names';

                    $rs = callQuery($pdo, $sql, $error);
                            while ($teamInfo = $rs->fetch()) {
                                if ($teamInfo['divisionId'] == $divInfo['divId']) {

                            ?>
                        <tbody>
                            <tr>
                                <td class="team"><?=$teamInfo['teamName']?></td>
                                <td><?=$teamInfo['wins']?></td>
                                <td><?=$teamInfo['losses']?></td>
                                <td><?=$teamInfo['ties']?></td>
                                <td class="pct">1.000</td>
                                <td><?=$teamInfo['homeRecord']?></td>
                                <td><?=$teamInfo['roadRecord']?></td>
                                <td><?=$teamInfo['divRecord']?></td>
                                <td><?=$teamInfo['confRecord']?></td>
                                <td><?=$teamInfo['pointsFor']?></td>
                                <td><?=$teamInfo['pointsAgainst']?></td>
                                <td class="color">+143</td>
                                <td class="streak">Won <?=$teamInfo['streak']?></td>
                            </tr>
                        </tbody>


                            <?php


                                }
                                }
                        }
                    
                    }
                ?>
    </body>
</html>
