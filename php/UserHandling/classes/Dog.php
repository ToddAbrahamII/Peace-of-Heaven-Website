<?php  

class Dog {
    private $_db,
            $_dogData, //contains dog data
            $_sessionName;

    /**
     * Connects to the Database
     */
    public function __construct() {
        $this->_db = DB::getInstance(); // Retrieve database instance

        $this->_sessionName = Config::get('session/session_name'); // Retrieve Session variable

    }

    /**
     * Creates a row in the Dog Database
     */
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
     * Finds the Vaccine info of the selected dog
     */
    public function findVaccineRecord($dog = null){
        if($dog){
            $fields = 'DogID';
            $data = $this->_db->get('dogvaccine', array($fields, '=', $dog));

            if($data->count() > 0) {
                $this->_dogData = $data->first();
                return true;
            }
        }else{
            return false;
        }
    }


    /**
     * Writes to behavior table
     * @param mixed $fields
     * @throws \Exception
     * @return void
     */
    public function createBehaviorRecord($fields) {
        if(!$this->_db->insert('dogbehavior', $fields)) {
            throw new Exception('There was a problem adding behavior info');
            //BehaviorID, IsSocial, FoodPref, IsJumper, IsEscapeArtist, IsClimber, IsLeashedTrained, IsChewer, Is
        }
    }

    /**
     * Finds the Vaccine info of the selected dog
     */
    public function findBehaviorRecord($dog = null){
        if($dog){
            $fields = 'DogID';
            $data = $this->_db->get('dogbehavior', array($fields, '=', $dog));

            if($data->count() > 0) {
                $this->_dogData = $data->first();
                return true;
            }
        }else{
            return false;
        }
    }

     /**
     * Writes to behavior table
     * @param mixed $fields
     * @throws \Exception
     * @return void
     */
    public function createHealthRecord($fields) {
        if(!$this->_db->insert('doghealth', $fields)) {
            throw new Exception('There was a problem adding behavior info');
            //BehaviorID, IsSocial, FoodPref, IsJumper, IsEscapeArtist, IsClimber, IsLeashedTrained, IsChewer, Is
        }
    }

    /**
     * Finds the Vaccine info of the selected dog
     */
    public function findHealthRecord($dog = null){
        if($dog){
            $fields = 'DogID';
            $data = $this->_db->get('doghealth', array($fields, '=', $dog));

            if($data->count() > 0) {
                $this->_dogData = $data->first();
                return true;
            }
        }else{
            return false;
        }
    }

    
    /**
     * Finds the first dog in the table linked to the CustID
     * @param mixed $fields
     * @throws \Exception
     * @return void
     */
    public function findDogInfo($customer = null){
        if($customer){
            $fields = 'CustID';
            $data = $this->_db->get('dog', array($fields, '=', $customer));

            if($data->count() > 0) {
                $this->_dogData = $data->first();
                return true;
            }
        }else{
            return false;
        }
    }

    /**
     * Finds first dog in the table linked to DogID
     */
    public function findDogInfoWithDogID($dog = null){
        if($dog){
            $fields = 'DogID';
            $data = $this->_db->get('dog', array($fields, '=', $dog));

            if($data->count() > 0) {
                $this->_dogData = $data->first();
                return true;
            }
        }else{
            return false;
        }
    }

    /**
     * Finds all dogs in the Dog table linked to CustID
     * @param mixed $fields
     * @throws \Exception
     * @return void
     */
    public function findDogArray($customer = null){
        if($customer){
            $fields = 'CustID';
            $data = $this->_db->get('dog', array($fields, '=', $customer));

            if($data->count() > 0) {
                $this->_dogData = $data->results();
                return true;
            }
        }else{
            return false;
        }
    }
   
    /**
     * Finds all dogs, good for admin uses when fetching reservation
     */
    public function findAllDogs()
    {
        $data = $this->_db->get();
        $this->_dogData = $data->results();
        
    }
    
    
      /** 
     * Updates dog table
    */
    public function update( $fields, $key, $keyValue) {

        if(!$this->_db->updateTable('dog', $fields, $key, $keyValue)) { // if ID provided, update provided user that matches id
            throw new Exception('There was a problem updating this user.');
        }
        return true;
    }


    /**
     * Returns the data of the row of dog that has been selected
     */
    public function data(){
        return $this->_dogData;
    }

}


