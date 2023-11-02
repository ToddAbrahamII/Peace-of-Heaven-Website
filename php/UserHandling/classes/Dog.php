<?php  

class Dog {
    private $_db,
            $_dogData, //contains dog data
            $_sessionName;

    public function __construct() {
        $this->_db = DB::getInstance(); // Retrieve database instance

        $this->_sessionName = Config::get('session/session_name'); // Retrieve Session variable

    }

    public function create($fields) {
        $uid = Session::get(Config::get('session/session_name'));
        print_r($uid);

        if (!$this->_db->insert('dog', $fields)) {
            throw new Exception('There was a problem adding your info.');
        }
    }

    public function getDogData(){
        return $this->_dogData;
    }

    public function find($customer = null) {
        if($customer) {
            $field = (is_numeric($customer)) ? 'id' : 'username';
            $data = $this->_db->get('customer', array($field, '=', $customer));

            if($data->count() > 0) {
                $this->_dogData = $data->first();
                return true;
            }
        }
        return false;
    }
}


