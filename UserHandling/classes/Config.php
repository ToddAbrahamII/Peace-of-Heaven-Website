<?php
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