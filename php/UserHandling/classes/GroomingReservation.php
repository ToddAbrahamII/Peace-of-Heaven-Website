<?php
class GroomingReservation {
    private $_db,
            $_groomingReservationData,
            $_sessionName,
            $_cookieName;
    private $service;
    /**
     * @var array
     */
    private $dogs;

    public function __construct($service, array $dogs) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get("session/session_name");
        $this->_cookieName = Config::get("remember/cookie_name");


        $this->service = $service;
        $this->dogs = $dogs;
    }

    /**
     * Summary of createReservation
     * @param mixed $fields
     * @throws \Exception
     * @return void
     */
    public function createReservation($fields) {

        if (!$this->_db->insert('grooming_reservation', $fields)) {
            throw new Exception('There was a problem creating a grooming reservation');
        }
        $this->_groomingReservationData = $fields;
    }


    /**
     * @param mixed $reservationData
     */
    public function setReservationData($reservationData)
    {
        $this->_groomingReservationData = $reservationData;
    }

    /**
     * Used to retrieve grooming Reservation Data
     * @return mixed
     */
    public function getReservationData()
    {
        return $this->_groomingReservationData;
    }

     /**
     * Retrieves all unapproved grooming reservations (Admin Use)
     */
    public function getUnApprovedReservations(){
        //Gathers all data as a string
        $data = $this->_db->get('grooming_reservation', array('isApproved', '=', 0));

        if($data->count() > 0) {
            //Takes all data, sorts into an array so it can be printed in rows
            $this->_groomingReservationData = $data->results();
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get Unapproved Grooming Appointments by CustID
     */
    public function getUnApprovedReservationsWithCustID($customer = null){
        if($customer){
        //Gathers all data as a string
        $data = $this->_db->get('grooming_reservation', array('CustID', '=', $customer));

        if($data->count() > 0) {
            //Takes all data, sorts into an array so it can be printed in rows
            $this->_groomingReservationData = $data->results();
            return true;
        }else{
            return false;
        }
    }
    }





}