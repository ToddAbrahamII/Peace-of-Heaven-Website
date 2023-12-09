<?php

Class PrintForm {

    private $_db,
            $_sessionName,
            $_reservationData;
    private $reservationId;

    // Instances of Objects to call methods. Will not store data.
    private $user, $customer, $dog, $reservation;



    public function __construct($reservationId) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');

        $this->reservationId = $reservationId;

        $this->user = new User();
        $this->customer = new Customer();
        $this->dog = new Dog();
        $this->reservation = new Reservation('serviceHardCode', array());
    }

    /**
     * Populate class with user data, customer data, dog data, and reservation data from ReservationID
     *
     * @return void
     */
    public function GetPrintData($reservationId) {

        // Get reservation by ID
        $this->_reservationData = $this->reservation->getReservationById($reservationId);

        // Get Customer by res->CustId
        

        // Get Dog Data by res->DogId
    }

    public function reservationData() {
        return $this->_reservationData;

    }


}


