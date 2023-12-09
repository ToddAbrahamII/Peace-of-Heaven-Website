<?php

class Hash {
    public static function make($string, $salt = '') {
        return hash("sha256", $string . $salt);
    }

    /**Generates a string of random text of Length $length
     *
     * @Algorithm bin2hex, random_bytes
     * @param $length - length of salt
     * @return string
     * @throws Exception
     */
    public static function salt($length) {
        $temp = bin2hex(random_bytes($length/2));
        echo $temp;
        return $temp;
    }

    public static function unique() {
        return self::make(uniqid());
    }
}