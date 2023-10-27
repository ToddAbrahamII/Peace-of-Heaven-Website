<?php 
//ADDED TO FUNCTIONS.PHP
/**
 * Generates and checks a session's token to prevent against cross-site scripting attacks
 * 
 * Should be included in any page that a user inputs data/
 */
class Token {
    /**
     * Summary of generate
     * @return mixed
     */
    public static function generate() {
        return Session::put(Config::get('session/token_name'), md5(uniqid()));
    }

    /**
     * Summary of check
     * @param mixed $token
     * @return bool
     */
    public static function check($token) {
        $tokenName = Config::get('session/token_name');

        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}