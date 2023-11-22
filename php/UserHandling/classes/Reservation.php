<?php
class Reservation {
    private $_db,
            $_reservationData;

    public $ResID,
            $ResStartTime,
            $ResEndTime,
            $emerContactName,
            $isApproved,
            $custId,
            $kennlId;

    private $dogs, $service;


    /**
     * Constructs the reservation
     */
    public function __construct($service, array $dogs) {
        $this->_db = DB::getInstance();
        $this->service = $service;
        $this->dogs = $dogs;

    }


    /**
     * Creates reservation
     */
    public function createReservation($fields) {

        if (!$this->_db->insert('reservation', $fields)) {
            throw new Exception('There was a problem creating a grooming reservation');
        }
        $this->_reservationData = $fields;
    }


    /**
     * @param mixed $reservationData
     */
    public function setReservationData($reservationData)
    {
        $this->_reservationData = $reservationData;
    }

    /**
     * Gathers reservation data
     */
    public function getReservationData()
    {
        return $this->_reservationData;
    }

    /**
     * Finds all unapproved reservation
     */
    public function getUnapprovedReservations(){
        //Gathers all data as a string
        $data = $this->_db->get('reservation', array('isApproved', '=', 0));

        if($data->count() > 0) {
            //Takes all data, sorts into an array so it can be printed in rows
            $this->_reservationData = $data->results();
            return true;
        }else{
            return false;
        }
    }

    /**
     * Find reservation id with the resID
     */
    public function getReservationById($reservationId) {
        $fields = 'Res_ID';
        $data = $this->_db->get('reservation', array($fields, '=', $reservationId));

        if($data->count() > 0) {
            $this->_reservationData = $data->first();
            return true;
        }
        return false;
    }

    /**
     * Finds all  reservations with custID
     */
    public function getUnApprovedReservationsWithCustID($customer = null)
    {
        $whereConditions = array(
            'isApproved' => 0,
            'isFinished' => 0,
            'CustID' => $customer,
        );

        $data = $this->_db->selectWhere('reservation', $whereConditions);

        if ($data->count() > 0) {
            $this->_reservationData = $data->results();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Finds all checked in Reservations
     */
    public function getCheckedInReservations() {
        $whereConditions = array(
            'isApproved' => 1,
            'isCheckedIn' => 1,
            'isFinished' => 0,
        );

        $data = $this->_db->selectWhere('reservation', $whereConditions);

        if ($data->count() > 0) {
            $this->_reservationData = $data->results();
            return true;
        } else {
            return false;
        }


    }

    /**
     * Finds all unchecked Reservations
     */
    public function getUncheckedReservations(){
        $fields = 'isCheckedIn';
        $values = 0;
        $data = $this->_db->get('reservation', array($fields, '=', $values));

        if ($data->count() > 0) {
            $this->_reservationData = $data->results();
            return true;
        }
        return false;
    }

    /**
     * Inserts Reservation
     */
    public function insertReservation($fields) {
        $this->_db->insert('reservation', $fields);
    }

    /**
     * Gets confirmed unfinished reservations
     */
    public function getConfirmedReservations(){
        $whereConditions = array(
            'isApproved' => 1,
            'isFinished' => 0,
        );

        $data = $this->_db->selectWhere('reservation', $whereConditions);

        if ($data->count() > 0) {
            $this->_reservationData = $data->results();
            return true;
        } else {
            return false;
        }

    }

     /**
     * Gets confirmed reservations for customer
     */
    public function getConfirmedReservationsWithCustID($customer){
        $whereConditions = array(
            'isApproved' => 1,
            'isFinished' => 0,
            'CustID' => $customer,
        );

        $data = $this->_db->selectWhere('reservation', $whereConditions);

        if ($data->count() > 0) {
            $this->_reservationData = $data->results();
            return true;
        } else {
            return false;
        }

    }

        /**
     * Finds all reservations belonging to customer ID
     */
    public function getReservationsWithCustID($customer){
        $fields = 'CustID';
        $data = $this->_db->get('reservation', array($fields, '=', $customer));

        if($data->count() > 0) {
            $this->_reservationData = $data->results();
            return true;
        }
        return false;
    }

    public function getCustomerDataFromReservation() {
        
    }






}