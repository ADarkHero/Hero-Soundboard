<?php
    //Error/Success code, that gets displayed, when the user presses the submit button
    $errsucccode = "";
    require_once 'database.php';

    //Was the post function used?
    if(isset($_POST["soundName"])){
        //Was the entered password correct?
        if(isset($_POST["password"]) && $_POST["password"] === $admin_pass){
            //Did the user input a name and chose a file?#
            //If yes, upload the file and write the data to the database.
            if(strlen($_POST["soundName"]) !== 0 && !empty($_FILES['soundFile'])){
                $path = "sound/";
                $path = $path . basename( $_FILES['soundFile']['name']);
                
                if(move_uploaded_file($_FILES['soundFile']['tmp_name'], $path)) {
                    $sql = "INSERT INTO ".$table_name." (SoundName, SoundDescription, SoundFilePath, SoundCategory) "
                        . "VALUES ('".htmlspecialchars($_POST["soundName"], ENT_QUOTES)."', '".htmlspecialchars($_POST["soundDescription"], ENT_QUOTES)."', '"
                                . "".$path."', '".htmlspecialchars($_POST["soundCategory"], ENT_QUOTES)."')";
                
                    $statement = $pdo->prepare($sql);
                    $statement->execute();

                    $errsucccode = "The file ".  basename( $_FILES['soundFile']['name']). 
                    " has been uploaded and added to the soundboard!"; 
                } else{
                    $errsucccode = "There was an error uploading the file, please try again!"; 
                }
            }
            else{
               $errsucccode = "Input a sound name and choose a file, please!"; 
            }    
        }
        else{
            $errsucccode = "Your password is wrong."; 
        }      
        
        $errsucccode .= "<br><br>"; //New line, after the text message
    }
?>



<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>ADarkHero Soundboard - Admin Interface</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Spectral" rel="stylesheet">
    </head>
    <body>
        
        <div id="center">
            <?php echo '<div id="errsucccode">'.$errsucccode.'</div>'; ?>
            
            <form method="post" enctype="multipart/form-data" action="admin.php">
                <div class="form-group">
                    <label for="soundName">Sound name</label>
                    <input type="text" class="form-control" id="soundName" name="soundName" aria-describedby="soundName" placeholder="What's the name of the sound?">
                </div>
                <div class="form-group">
                    <label for="soundDescription">Sound description</label>
                    <input type="text" class="form-control" id="soundDescription" name="soundDescription" aria-describedby="soundDescription" placeholder="Do you want to add a description?">
                </div>
                <div class="form-group">
                    <label for="soundCategory">Sound group</label>
                    <input type="text" class="form-control" id="soundCategory" name="soundCategory" aria-describedby="soundCategory" placeholder="Which group shall be used?">
                </div>
                <div class="form-group">
                    <label for="soundFile">Upload sound file</label>
                    <input type="file" class="form-control" id="soundFile" name="soundFile" aria-describedby="soundFile" placeholder="Upload your sound file.">
                </div>
                <div class="form-group">
                    <label for="password">Administrator password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
    
            </form>
        </div>
    </body>
</html>



