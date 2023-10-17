<?php
// Method to sanitize database queries before interacting with DB server
function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}