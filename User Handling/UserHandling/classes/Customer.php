<?php  

class Customer {
    private $_db,
            $_data,
            $_sessionName;

    public function __construct() {
        $this->_db = DB::getInstance();

        $this->_sessionName = Config::get('session/session_name');

    }

    public function create($fields) {
        if (!$this->_db->insert('customer', $fields)) {
            throw new Exception('There was a problem creating an account.');
        }
    }

    private function data() {
        return $this->_data;
    }
}


