<?php
// Validate everything very quickly.
class Validate {

    private $_passed = false,
        $_errors = array(),
        $_db = null;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function check ($source, $items = array()) {
        foreach ($items as $item => $rules) {
            foreach($rules as $rule => $rule_value) {
                $value = $source[$item];

                if($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required") ; // opportunity for increased functionality to set username for example

                } else {

                }
                echo "{$item} {$rule} must be {$rule_value}<br>";
            }
        }

        if(empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    private function addError($error) {
        $this->_errors[] = $error;
    }

    //check for errors
    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        $this->_passed;
    }

    // create an instance of our database

}
