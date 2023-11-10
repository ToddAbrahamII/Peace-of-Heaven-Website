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
     * @return mixed
     */
    public function getReservationData()
    {
        return $this->_groomingReservationData;
    }





}