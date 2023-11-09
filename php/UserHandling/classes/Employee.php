<?php  

class Employee {
    private $_db,
            $_userData, // contains user data
            $_sessionName;

    public function __construct() {
        $this->_db = DB::getInstance(); // Retrieve database instance

        $this->_sessionName = Config::get('session/session_name'); // Retrieve Session variable

    }

    /**
     * @param $fields
     * @return void
     * @throws Exception
     */
    public function create($fields) {
        if (!$this->_db->insert('employee', $fields)) {
            throw new Exception('There was a problem adding your info.');
        }

    }

    public function data() {
        return $this->_userData;
    }
}


