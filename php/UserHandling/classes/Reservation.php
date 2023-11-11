<?php
class Reservation {
    private $_db,
            $_reservationData;

    private $ResID,
            $ResStartTime,
            $ResEndTime,
            $emerContactName,
            $isApproved,
            $custId,
            $kennlId;

    private $dogs, $service;


    public function __construct($service, array $dogs) {
        $this->_db = DB::getInstance();
        $this->service = $service;
        $this->dogs = $dogs;

    }



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

    public function getReservationData()
    {
        return $this->_reservationData;
    }

    public function getUnApprovedReservations(){
        //Gathers all data as a string
        $data = $this->_db->get('grooming_reservation', array('isApproved', '=', 0));

        if($data->count() > 0) {
            //Takes all data, sorts into an array so it can be printed in rows
            $this->_reservationData = $data->results();
            return true;
        }else{
            return false;
        }
    }

    public function getReservationById($reservationId) {
        $fields = 'GroomResID';
        $data = $this->_db->get('grooming_reservation', array($fields, '=', $reservationId));

        if($data->count() > 0) {
            $this->_reservationData = $data->first();
            return true;
        }
        return false;
    }

    public function getUnApprovedReservationsWithCustID($customer = null)
    {
        if ($customer) {
            //Gathers all data as a string
            $data = $this->_db->get('grooming_reservation', array('CustID', '=', $customer));

            if ($data->count() > 0) {
                //Takes all data, sorts into an array so it can be printed in rows
                $this->_reservationData = $data->results();
                return true;
            }
        }
        return false;
    }


    public function insertReservation($fields) {
        $this->_db->insert('reservation', $fields);
    }

    /**
     * @param mixed $dogId
     */
    public function setDogId($dogId)
    {
        $this->dogId = $dogId;
    }




}