<?php

//Method to Verify the Credentials of a Login
function check_login($connection)
{
    if(isset($_SESSION['User_ID'])) //check if user_id is inside in session
    {
        //Verifying Credintials
        $id = $_SESSION['User_ID']; //ID Comparison
        $query = "SELECT * FROM Login WHERE User_ID = '$id' limit 1"; //SQL Query to Grab User ID

        $result = mysqli_query($connection, $query); //Calls the connection and SQL Query

        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result); //Fetches Associated Array
            return $user_data; //Returns the data
        }
    }

    //Redirect to Login
    header("Location: login.php");
    die; 

}

//Generates random number
function random_num($length)
{
    $text = "";
    //Chech Length
    if($length < 5)
    {
        $length = 5; //Checks length always at least 5 
    }

    //Gets Random Length for user_id
    $len = rand(4,$length);

    //Repeat to get lenght of random nums
    for($i=0; $i < $len; $i++)
    {
        $text .= rand(0,9); //randomly generates
    }
    return $text;


}

?>