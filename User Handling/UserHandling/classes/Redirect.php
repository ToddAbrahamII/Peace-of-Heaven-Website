<?php  
/**
 * Class is called to redirect user to specific page when a particular operation succeeds/fails. (e.g. user successfully registers a new account)
 */
Class Redirect {
    /**
     * Summary of to
     * @param mixed $location
     * @return void
     */
    public static function to($location = null) {
        if ($location) { // if defined
            if (is_numeric($location)) {
                switch($location) {
                    case 404:
                        header('Http/1.0 404 Not Found');
                        include 'includes/errors/404.php';
                        exit();
                    break;
                }
            }
            header('Location: ' . $location);
            exit();
        }
    }
}