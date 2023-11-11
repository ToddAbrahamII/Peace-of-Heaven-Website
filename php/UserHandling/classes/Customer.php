<?php  

class Customer {
    private $_db,
            $_customerData, //contains customer data
            $_sessionName;

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
     * @return mixed
     *
     */
    public function getCustomerData() {
        return $this->_customerData;
    }

    /**
     * @param $user
     * @return bool|void
     *
     * @note selectCustInfo($user)
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

}


