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

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'login'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token' 
    )
);

class Config {
    
    public static function get($path = null) {
        if($path) {
            $config = $GLOBALS['config'];
            // separates into array delimited by '/'
            $path = explode('/',$path);
            
            foreach($path as $bit ) {
                if(isset($config[$bit])) { //check if set in confit
                    
                    $config = $config[$bit];
                } else {
                    // Return false if a path component doesn't exist
                    return false;
                }
            }

            return $config;
            
        }
        return false;
    }
}

class Session {
    
    public static function exists($name) {
        return (isset($_SESSION[$name])) ? true : false;

    }
    public static function put($name, $value) {
        return $_SESSION[$name] = $value;
    }

    public static function get($name) {
        return $_SESSION[$name];
    }

    public static function delete($name) {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Flash a message to user that will be gone once it refreshes
     * @param mixed $name
     * @param mixed $string
     * @return void
     */
    public static function flash($name, $string = '') {
        if(Self::exists($name)) {
            $session = Self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name,$string);
        }
        return '';
    }

}

/**
 * function to sanitize database queries before interacting with DB server
 * 
 * @param mixed $string
 * @return string
 */
function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

class Token {
    /**
     * Summary of generate
     * @return mixed
     */
    function generate() {
        return Session::put('token', md5(uniqid()));
    }

    /**
     * Summary of check
     * @param mixed $token
     * @return bool
     */
   function check($token) {
        $tokenName = Config::get('session/token_name');

        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}

?>