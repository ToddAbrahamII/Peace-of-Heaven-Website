<?php
//ADDED TO FUNCTIONS.PHP
/**
 * function to sanitize database queries before interacting with DB server
 * 
 * @param mixed $string
 * @return string
 */
function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}