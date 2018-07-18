<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Book Lister - using PDO</title>
        <link href="css/bookLister.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
        <?php
            require 'dbConnect.php';
            
            function callQuery($pdo, $query, $error) {
                
                try {
                    return $pdo->query($query);
                } catch (PDOException $ex) {
                    $error .= $ex->getMessage();
                    include 'error.html.php';
                    exit();
                }
            }
            
            // Check to see fi the user clicked the Add anew book title link
            if(isset($_GET['clicked'])) {
                $clicked = $_GET['clicked'];
            } else {
                $clicked = 0;
            }
            
            
            // If add new book title link was clicked... display the add a new form
            if ($clicked == 1) {
                
                ?>
            
            <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
                <label id="bookArea" for="newBookTitle">Enter the book's title</label><br>
                <textarea name="newBookTitle" id="newBookTitle" rows="10" cols="40">Enter book title</textarea><br><br>
                
                <label id="bookAuthor" for="newAuthor">Enter the author of this book</label><br>
                <input type="text" name="newAuthor" id="newAuthor"><br><br>
                
                <label id="genre" for="bookCategory">Enter book category</label><br>
                <select name="bookCategory" id="bookCategory">
                    <?php
                        
                        $closeSelect = true;
                        
                        $query = 'select * FROM categories';
                        $error = 'Error fetching book categories';
                        
                        $categoryResult = callQuery($pdo, $query, $error);
                        
                        echo "\n";
                        // New lets step through the result set one row at a time.
                        while ($row = $categoryResult->fetch()) {
                          ?>
                    <option value="<?= $row['id']?>"><?= $row['name'] ?></option>
                    <?php
                    
                        }
                        ?>
                </select>
                <br><br>
                
                <input type="submit" name="addBook" value="Add book">
                
            </form>
            <?php
            }
            
            ?>
            <h2 id="topHeading">The Book Review</h2>
            
            <?php
            // Check if user submitted the add a new book form, and if so 
            // validate their entered data.
            
            
            
            if (isset($_POST['newBookTitle']) && ($_POST['newBookTitle'] != "Enter book title") && $newBookTitle = trim(strip_tags($_POST['newBookTitle']))) {
                // Now, we have a valid book title, so lets check if an author has been entered
                if (!$newAuthor = trim(strip_tags($_POST['newAuthor']))) {
                    $newAuthor = "Anonymous";
                }

                // Replace any single quote in our book title with an 
                // excaped single quote so our query does not fail
                $newBookTitle = str_replace("'", "\\", $newBookTitle);
                $newAuthor = str_replace("'", "\\", $newAuthor);
                echo "<h3>New book title = $newBookTitle</h3>\n";
                echo "<h3>New book author = $newAuthor</h3>\n";
                
                // Check if new book title already exists in our db
                $query = "SELECT COUNT(bookTitle)
                          FROM bookstuff
                          WHERE bookTitle = '$newBookTitle'";
                
                $error = "Error fetching book title";
                
                $numBookTitles = callQuery($pdo, $query, $error) -> fetchColumn();
                
                // Did we find the new book title?
                if ($numBookTitles) {  // New book is duplicate
                    
                    ?>
            <h3 style="color: #fff;">New book title <?= $newBookTitle ?> already exists - not added</h3>
            
            <?php 
            
                } else {  // New book was not found in DB, so add it
                    
                    ?>
            <h3 style="color: #fff;">New book title <?= $newBookTitle ?> added</h3>
            <h3 style="color: #fff;">New book author <?= $newAuthor ?></h3>
            
            <?php 
            
            // Now that we know we want to add the new book, we
            // should also check if the new book's author already exists
            $query = "SELECT COUNT(*)
                          FROM authors
                          WHERE authorName = '$newAuthor'";
                
                $error = "Error fetching book author";
                
                $numAuthorRows = callQuery($pdo, $query, $error) -> fetchColumn();
                
                // Did we find our new author?
                if ($numAuthorRows) { // We found it
                    
                    ?>
            <h3 style="color: #fff;">New book author <?= $newAuthor ?> already exists - not added</h3>
            <?php 
                    
                } else { // New author not found - so not added
                    
                    try {
                        
                        // Use and sql prepared statement to prevent SQL injection attacks.
                        // with this insert of $newAuthor. 
                        //
                        // :newAuthor below is a placeholder
                        //
                        // PDO is smart enough to guard against dangerous characters
                        // automatically
                        //
                        $sql = "INSERT INTO authors SET authorName=:newAuthor";
                        
                        $s = $pdo->prepare($sql);
                        // $s is now a PDOStatement Object
                        
                        // Bind our live $newAuthor value into the ':newAuthor' 
                        // placeholder 
                        $s->bindValue(':newAuthor', $newAuthor);
                        
                        // Execute the query
                        $s->execute();
                        
                         ?>
            <h3 style="color: #fff;">Your new author <?= $newAuthor ?> has been added.</h3>
            <?php 
                        
                    } catch (PDOException $ex) {

                        $error = 'Error performing insert of author name: ' . $ex->getMessage();
                        include 'error.html.php';
                        exit();
                    
                    }
            
                } // End else new author was not found so added it
                
                // Now we are ready to insert our new book title,
                // but wait, first we need to obtain the new books's
                // author's id
                $query = "SELECT id
                      FROM authors
                      WHERE authorName = '$newAuthor'";
                
                $error = 'Eror fetching book author\'s id: ';
                
                $newAuthorResult = callQuery($pdo, $query, $error);
                
                // Extract the authors id from the result set
                $row = $newAuthorResult->fetch();
                
                $newAuthorId = $row['id'];
                
                // Get new book category id
                if (isset($_POST['bookCategory'])) {
                    
                    $bookGenre = $_POST['bookCategory'];
                    
                } else {
                    
                    $bookGenre = 1;
                }
                
                // Yay, insert new book
                try {
                    
                    $sql = "INSERT INTO bookstuff(booktitle, catId, authorId)
                        VALUES(:newTitle, :bookGenre, $newAuthorId)";
                    
                    $s = $pdo->prepare($sql);
                    // $s is now a PDOStatement Object

                    // Bind our live $newAuthor value into the ':newAuthor' 
                    // placeholder 
                    $s->bindValue(':newTitle', $newBookTitle);
                    $s->bindValue(':bookGenre', $bookGenre);

                    // Execute the query
                    $s->execute();
                    
                } catch (PDOException $ex) {
                    
                    $error = 'Error performing insert of new book: ' . $ex->getMessage();
                    include 'error.html.php';
                    exit();

                }
                
                } // End if newBookTitle not found adding it
                
            } // End if new book tile is valid
            
            
            /*
            // echo "Connection successful!";
    
            // At this point it means we connected to server and database
            // Run a query to retrieve our book categories
            try {
                $categoryResult = $pdo->query('SELECT * FROM categories');
                
            } catch (PDOException $ex) {
                  $error = 'Error fetching book categories: ' . $ex->getMessage();
                  include 'error.html.php';
                  exit();
            }   // Used call query function instead
             
            */
            
            $query = 'SELECT * FROM categories';
            $error = 'Error fetching book categories: ';
            
            $categoryResult = callQuery($pdo, $query, $error);
            
            // Step through the categories in our result set (PDOStatement Object)
            //
            // While remaining rows in result set, fetch the next row
            // 
            // $categoryResult is PDOStatement Object so we can run fetch() on it
            while($bookType = $categoryResult->fetch()) {
                
                $genreId = $bookType['id'];  // current category's id
                $genreName = $bookType['name'];  // current category's name
                
                ?>
            <div class="bookGenre">
                <h3><?= $genreName ?></h3>
                <?php
                //  Run a query to obtain all book titles and their authors
                // for the current book category (using $genreId) ordering
                // them by book title
                /* try {
                    $sql = "SELECT bookTitle, authorName FROM bookstuff, authors WHERE bookstuff.authorId = authors.id AND bookstuff.catId = $genreId ORDER BY bookTitle";
                    
                    $booksResult = $pdo->query($sql);
                    
                } catch (PDOException $ex) {
                      $error = 'Error fetching book info: ' . $ex->getMessage();
                      include 'error.html.php';
                      exit();
                }
                */
                
                $query = "SELECT bookTitle, authorName FROM bookstuff, authors WHERE bookstuff.authorId = authors.id AND bookstuff.catId = $genreId ORDER BY bookTitle";
                $error = 'Error fetching book info: ';
            
                $booksResult = callQuery($pdo, $query, $error);
                
                ?>
                <blockquote>
                <?php
                
                // Step through the $booksResult result set and
                // display each book in this category
                while($book = $booksResult->fetch()) {
                    
                    ?>
                    <p>
                        <?= $book['bookTitle'] ?><br>
                        <span class="author"><?= $book['authorName'] ?></span>
                    </p>
                    
                    <?php
                    
                } 
                
                ?>
                    
                </blockquote>
                <?php
                
                
                ?>
            </div>
            <?php
                
            } // While more rows in category result set line 35
            
          ?>
            <br><br>
            <a href="<?php echo "$_SERVER[PHP_SELF]?clicked=1" ?>">Add new book title!</a>
        </div>
    </body>
</html>
