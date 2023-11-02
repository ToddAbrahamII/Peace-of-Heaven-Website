<?php  

class Customer {
    private $_db,
            $_userData, // contains user data
            $_customerData, //contains customer data
            $_sessionName;

    public function __construct() {
        $this->_db = DB::getInstance(); // Retrieve database instance

        $this->_sessionName = Config::get('session/session_name'); // Retrieve Session variable

    }

    public function create($fields) {
        $uid = Session::get(Config::get('session/session_name'));
        print_r($uid);

        if (!$this->_db->insert('customer', $fields)) {
            throw new Exception('There was a problem adding your info.');
        }
    }

    public function getUserData() {
        return $this->_userData;
    }

    public function getCustomerData() {
        return $this->_customerData;
    }
}


