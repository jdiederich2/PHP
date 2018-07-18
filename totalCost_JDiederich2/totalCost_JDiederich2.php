<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Total Cost</title>
        <link href='css/styles.css' rel='stylesheet'>
    </head>
    <body>
        <?php
        if (isset($_POST['submit'])) {

            $costPerWidget = 20;
            $taxRate = 1.06;
            $discountRate = 0.25;

            $bgColor = $_POST['bgColor'];
            $fgColor = $_POST['fgColor'];
            $fontChoice = $_POST['fontChoice'];

            ?> 
            <style>
                body {
                    background-color: <?= $bgColor?>; 
                    color: <?= $fgColor?>; 
                    font-family: <?=$fontChoice?>; 
                    font-size: 1.1em
                } 
                
                p {
                    width: 60%; 
                    background-color: <?= $fgColor?>; 
                    color: <?= $bgColor?>;
                    font-weight: 600; 
                    border-radius: 5px;
                }
            </style> 
            <?php
            
            $welcome = "<h2 style='text-shadow: none;'>TotalCost - Welcome $_POST[fName] $_POST[lName]!</h2>";

            if ((!$_POST['quantity'] > 0) or ( $_POST['quantity'] == "") or ( !is_numeric($_POST['quantity']))) {

                print $welcome . "<p>Please make sure that you entered a quantity and then resubmit<p>";
                exit();
            }

            $widgetSubtotal = widgetSubtotal($_POST['quantity'], $costPerWidget);

            if ($widgetSubtotal < 50) {

                $totalCost = $widgetSubtotal * $taxRate;

                print $welcome . "You requested " . $_POST['quantity'] . " widget(s) at $20 each. <br><br> Your total with tax comes to $"
                        . number_format($totalCost, 2) . '. <br><br>';
                
            } else {

                $discount = $widgetSubtotal * $discountRate;

                $totalCost = ($widgetSubtotal - $discount) * $taxRate;

                print $welcome . "You requested " . $_POST['quantity'] . " widget(s) at $20 each. <br><br> Your total with tax, minus your $"
                        . number_format($discount, 2) . " discount, comes to $" . number_format($totalCost, 2) . '. <br><br>';
            }

            echo "You may purchase the widget(s) in 12 monthly installments of $" . monthlyInstallments($totalCost) . " each.";
            
        } else {
            ?> 
            <h2>Total Cost input form</h2>

            <form name="widgets" action="totalCost_JDiederich2.php" method="post">

                <label for="fName">First Name: </label>
                <input type="text" name="fName" id="fName">
                <br>

                <label for="lName">Last Name: </label>
                <input type="text" name="lName" id="lName">
                <br><br>

                <label for="fgColor"> Foreground Color: </label>
                <select name="fgColor" id="fgColor">
                    <option value="#ffb300">orange</option>
                    <option value="rgb(176, 23, 31)">indian red</option>
                    <option value="rgb(75, 0, 130)">indigo</option>
                    <option value="rgb(72, 61, 139)">darkslateblue</option>
                    <option value="rgb(132, 112, 255)">lightslateblue</option>
                    <option value="rgb(69, 139, 0)">chartreuse4</option>
                    <option value="rgb(162, 205, 90)">darkolivegreen3</option>
                </select>
                <br><br>

                <label for="bgColor">Background Color: </label>
                <select name="bgColor" id="bgColor">
                    <option value="rgb(75, 0, 130)">indigo</option>
                    <option value="rgb(176, 23, 31)">indian red</option>
                    <option value="rgb(72, 61, 139)">darkslateblue</option>
                    <option value="rgb(132, 112, 255)">lightslateblue</option>
                    <option value="rgb(69, 139, 0)">chartreuse4</option>
                    <option value="rgb(162, 205, 90)">darkolivegreen3</option>
                    <option value="#ffb300">orange</option>
                </select>
                <br><br>

                <label for="fontChoice">Font Choice: </label>
                <select name="fontChoice" id="fontChoice">
                    <option value="Trebuchet MS">Trebuchet MS</option>
                    <option value="Jokerman">Jokerman</option>
                    <option value="Papyrus">Papyrus</option>
                    <option value="Comic Sans MS">Comic Sans MS</option>
                    <option value="Tekton Pro">Tekton Pro</option>
                    <option value="Arial">Arial</option>
                    <option value="Courier New">Courier New</option>
                    <option value="Verdana">Verdana</option>
                </select>
                <br><br>

                <label for="quantity">Number of Widgets: </label>
                <input type="text" name="quantity" id="quantity">
                <br><br>

                <input type="submit" name="submit" id="submit" value="Calculate Cost">
                <input type="reset" name="reset" id="reset" value="Clear">
            </form>
    <?php
// ----------------------------------------------------------------------------------------------------------//  
// FUNCTIONS //
// __________________________________________________________________________________________________________ //     
}

function widgetSubtotal($widgetQuantity, $costPerWidget) {
    $widgetSubtotal = $widgetQuantity * $costPerWidget;
    return $widgetSubtotal;
}

function monthlyInstallments($totalCost) {
    return number_format(($totalCost / 12), 2);
}
?>         
    </body>
</html>