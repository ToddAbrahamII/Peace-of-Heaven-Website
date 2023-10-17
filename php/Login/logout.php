<?php

session_start(); //Require for all pages, starts session

//Unsets the session
if(isset($_SESSION['User_ID']))
{
    unset($_SESSION['User_ID']);
}

//Redirect User
header("Location: login.php");
die;