<?php  

class DogHealth {
    private $_db,
            $_healthData, //contains dog data
            $_sessionName;

    /**
     * Connects to the Database
     */
    public function __construct() {
        $this->_db = DB::getInstance(); // Retrieve database instance
        $this->_sessionName = Config::get('session/session_name'); // Retrieve Session variable


    }

    public function findHealthInfo($dogId) {
        $fields = 'DogID';
        $data = $this->_db->get('doghealth', array($fields, '=', $dogId));

        if($data->count() > 0) {
            $this->_healthData = $data->first();
            return true;
        }
        return false;
    }

    public function getHealthInfo(){
        return $this->_healthData;
    }

}