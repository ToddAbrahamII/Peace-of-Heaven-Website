<?php  

class Kennel {
    private $_db,
            $_kennelData, //contains customer data
            $_sessionName;

    public function __construct() {
        $this->_db = DB::getInstance(); // Retrieve database instance

        $this->_sessionName = Config::get('session/session_name'); // Retrieve Session variable

    }

    /**
     * Creates a kennel in the db
     */
    public function create($fields) {
        $uid = Session::get(Config::get('session/session_name'));
        print_r($uid);

        if (!$this->_db->insert('kennel', $fields)) {
            throw new Exception('There was a problem adding your info.');
        }
    }

    /**
     * Gathers all kennels
     */
    public function getKennels()
    {
         //Gathers all data as a string
         $data = $this->_db->get('kennel', array(1, '=', 1));

         if($data->count() > 0) {
             //Takes all data, sorts into an array so it can be printed in rows
             $this->_kennelData = $data->results();
             return true;
         }else{
             return false;
         }
    }

    /**
     * Returns data for kennel
     */
    public function data(){
        return $this->_kennelData;
    }

}


