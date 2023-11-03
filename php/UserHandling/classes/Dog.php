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

    /**
     * Writes to vaccine table
     * @param mixed $fields
     * @throws \Exception
     * @return void
     */
    public function createVaccineRecord($fields) {
        if (!$this->_db->insert('dogvaccine', $fields)) {
            throw new Exception('There was an issue adding vaccine info');
            //VacId, DHPP_Date, RabiesDate, BordellaDate, HasFleaTick, FleaTickDate, OtherVacInfo
        }
    }

    /**
     * Writes to behavior table
     * @param mixed $fields
     * @throws \Exception
     * @return void
     */
    public function createBehaviorRecord($fields) {
        if(!this->_db->insert('dogbehavior', $fields)) {
            throw new Exception('There was a problem adding behavior info');
            //BehaviorID, IsSocial, FoodPref, IsJumper, IsEscapeArtist, IsClimber, IsLeashedTrained, IsChewer, Is
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

    public function findDogInfo($customer = null){
        if($customer){
            $fields = 'CustID';
            $data = $this->_db->get('dog', array($fields, '=', $customer));

                $this->_dogData = $data;
                return true;
            
        }else{
            return false;
        }
    }


    public function data(){
        return $this->_dogData;
    }

}


