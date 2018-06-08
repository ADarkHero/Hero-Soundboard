<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>ADarkHero Soundboard</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Spectral" rel="stylesheet">
    </head>
    <body>
        <!-- GitHub Corner -->
        <a href="https://github.com/ADarkHero/Hero-Soundboard" target="blank" class="github-corner" aria-label="View source on Github"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#151513; color:#fff; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>
        
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
                    $search = "%".$_GET["search"]."%";
                    $sql .= "WHERE SoundName LIKE '".$search."' OR SoundDescription LIKE '".$search."' "
                            . "OR SoundFilePath LIKE '".$search."' OR SoundCategory  LIKE '".$search."' ";
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
            
            
            <div id="footer">
                Made with ❤ by <a href="http://www.adarkhero.de" target="_blank">ADarkHero</a> |
                This work is licensed under a <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank">Creative Commons Attribution 4.0 International License</a>.
            </div>
        </div>
        
        
        <script>
            function playSound(filename){
                var audio = new Audio(filename);
                audio.play(); 
            } 
        </script>
        
        
    </body>
</html>
