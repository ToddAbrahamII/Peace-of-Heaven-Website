<?php  

class Customer {
    private $_db,
            $_customerData, //contains customer data
            $_sessionName;

    /**
     * 
     */
    public function __construct() {
        $this->_db = DB::getInstance(); // Retrieve database instance

        $this->_sessionName = Config::get('session/session_name'); // Retrieve Session variable

    }

    /**
     * @param $fields
     * @return void
     * @throws Exception
     *
     * @note insertCustomer()
     */
    public function create($fields) {
        $uid = Session::get(Config::get('session/session_name'));
        print_r($uid);

        if (!$this->_db->insert('customer', $fields)) {
            throw new Exception('There was a problem adding your info.');
        }
    }

    /**
     * returns the customer data
     */
    public function getCustomerData() {
        return $this->_customerData;
    }

    /**
     * Finds Customer Info using the UserID
     */
    public function findCustInfo($user = null){
        if($user){
            $fields = 'User_ID';
            $data = $this->_db->get('customer', array($fields, '=', $user));

            if($data->count() > 0) {
                $this->_customerData = $data->first();
                return true;
            }
        }else{
            return false;
        }
    }

    /**
     * Finds the customer information using the CustID
     */
    public function findCustInfoWithCustID($customer = null){
        if($customer){
            $fields = 'CustID';
            $data = $this->_db->get('customer', array($fields, '=', $customer));

            if($data->count() > 0) {
                $this->_customerData = $data->first();
                return true;
            }
        }else{
            return false;
        }
    }

    /**
     * Returns the data of the customer object
     */
    public function data(){
        return $this->_customerData;
    }


    public function getAllCustomers() {
        $data = $this->_db->get('customer', array('1', '=', '1'));

        if($data->count() > 0) {
            $this->_customerData = $data->results();
            return true;
        }
        return false;
    }

    /** 
     * Updates Customer Table
    */
    public function update( $fields, $key, $keyValue) {

        if(!$this->_db->updateTable('customer', $fields, $key, $keyValue)) { // if ID provided, update provided user that matches id
            throw new Exception('There was a problem updating this user.');
        }
        return true;
    }



}


