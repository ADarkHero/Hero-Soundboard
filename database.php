<?php

    //Username, Password etc for database
    $db_host = "localhost";
    $db_name = "sound";
    $db_user = "root";
    $db_pass = "";
    $table_name = "sound";
    //Password for administrator interface
    $admin_pass = "root";

    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

?>
               