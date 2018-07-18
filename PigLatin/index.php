<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pig Latin</title>
        <style>
            body {
                color: green;
                font-family: Arial;
            }
        </style>
    </head>
    <body>
        <h1>Pig Latin Generator</h1>
        <?php
        
          if (!isset($_POST['go'])) {
              ?>
        
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        
            <textarea name="inputStr" rows="20" cols="40"></textarea>
            <br>
            <input type="submit" name="go" value="Pigify">
            
        </form>
        
        <?php
          } else { // form has been submitted, so translate string to piglatin
              
              if (isset($_POST['inputStr'])) {
                  
                  $newPhrase = "";
                  
                  // ensure the string is all lowercase
                  $str = strtolower($_POST['inputStr']);
                  
                  // break the string into separate words storing them in an array
                  $wordList = explode(" ", $str);
                  
                  // Step through each word and convert them to Pig Latiin
                  foreach ($wordList as $word) {
                      
                      if ($word) {
                          $word = trim($word, ".,:;'\" \t\n-()_0..9");
                          // print "$word *** ";
                          
                          // Break up the word into first letter and rest of word
                          $firstLetter = substr($word, 0, 1);
                          $restOfWord = substr($word, 1);
                          
                          // If first charadter is a vowel, then leave it in place 
                          // and append "way" to the end of the word.  Else, if the 
                          // first character is consonant, then move it 
                          // to the end of the word and append "ay"
                          if (strstr("aeiou", $firstLetter)) {
                              $newWord = $word . "way";
                          } else {  // FIrst letter not a vowel
                              $newWord = $restOfWord . $firstLetter . "ay";
                          }
                          
                          // Add $newWord to end of $newPhrase
                          $newPhrase .= $newWord . " ";
                      }  
                      
                  }
                  
                  echo "<h3 style\"color:navy\">In Pig Latin $newPhrase</h3>\n";
                  
              } else {
                  echo "<h3>Hey beloved user, I thought you wanted to play Pig Latin</h3>";
              }
              
          }

        ?>
    </body>
</html>
