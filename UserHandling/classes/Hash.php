<?php

class Hash {
    public static function make($string, $salt = '') {
        return hash("sha256", $string . $salt);
    }

    public static function salt($length) {
        $temp = bin2hex(random_bytes($length/2));
        echo $temp;
        return $temp;
    }

    public static function unique() {
        return self::make(uniqid());
    }
}