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
                $value = trim($source[$item]);
                $item = escape($item);

                if($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required") ; // opportunity for increased functionality to set username for example

                } else if(!empty($value)){
                    switch($rule) {
                        case 'min':
                            // Check string length is less than rule valu
                            if(strlen($value) < $rule_value) {
                                $this->addError('{$item} must be a minimum of {$rule_value} characters') ;
                            }
                        break;
                        case 'max':
                            // Check string length is greater than maximum
                            if(strlen($value) > $rule_value) {
                                $this->addError('{$item} must be a maximum of {$rule_value} characters') ;
                            }

                        break;
                        case 'matches':
                            // Check if value is not equal to source value
                            if($value != $source[$rule_value]) {
                                $this->addError('{$rule_value} must match {$item}');
                            }

                        break;
                        case 'unique': 
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if($check->count()) { // if not empty
                                $this->addError('{$item} already exists.');
                            }
                        break;
                    }
                }
                
            }
        }

        if(empty($this->_errors)) { // If there are any errors, return true
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


}
