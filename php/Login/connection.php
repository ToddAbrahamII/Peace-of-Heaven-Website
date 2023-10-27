<?php
     $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "peaceofheavendb";

    if(!$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
    {
        die("Failed to Connect to Database!");
    }

    

    