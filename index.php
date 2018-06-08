<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="center">
            <form action="index.php" method="get">
                <input type="search" class="search" name="search" class="search" placeholder="Search..." autofocus>
                <input type="submit" class="searchbutton" value="submit"></input>
                <a href="index.php"><input type="button" class="searchbutton" value="reset"></a></input>
            </form>

            <?php		
                require_once 'database.php';

                //If the user searches -> Display entries based on search
                //If not: Display everything
                $sql = "SELECT * FROM ".$table_name." ";
                if(isSet($_GET["search"])) {
                    $search = $_GET["search"];
                    $sql .= "WHERE SoundName LIKE '".$search."' OR SoundDescription LIKE '".$search."' OR SoundFilePath LIKE '".$search."' OR SoundCategory  LIKE '".$search."'";
                }      
                $sql .= "ORDER BY SoundCategory, SoundName";
                $statement = $pdo->prepare($sql);
                $result = $statement->execute();

                $lastCategory = "";
                for($i = 1; $row = $statement->fetch(); $i++) {
                    //If the category is different, make a new headline
                    if($lastCategory !== $row["SoundCategory"]){
                        echo '<h1 class="soundCategory">'.$row["SoundCategory"].'</h1>';
                    }

                    //Display the buttons in random colors  
                    $buttoncolors = array("primary", "secondary", "success", "danger", "warning", "info", "dark");
                    ?>
                    <button type="button" class="btn btn-outline-<?php echo $buttoncolors[rand(0, count($buttoncolors)-1)]; ?> btn-lg soundButton" onclick="playSound('<?php echo $row["SoundFilePath"];  ?>')">
                        <?php 
                            echo '<span class="soundName">'.$row["SoundName"].'</span>';  
                            if(strlen($row["SoundDescription"]) !== 0){
                                echo "<br><br>";
                                echo '<span class="soundDescription">'.$row["SoundDescription"].'</span>';  
                            }
                        ?>
                    </button>
                    <?php

                    //Save the used category, to check, if the category changes
                    $lastCategory = $row["SoundCategory"];
                }
            ?>
        </div>
        
        
        <script>
            function playSound(filename){
                var audio = new Audio(filename);
                audio.play(); 
            } 
        </script>
    </body>
</html>
