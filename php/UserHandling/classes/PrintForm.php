<?php

Class PrintForm {

    private $_db,
            $_sessionName,
            $_reservationData,
            $_printData;
    private $reservationId;

    private $user, $customer, $dog, $reservation;



    public function __construct($reservationId) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');

        $this->reservationId = $reservationId;

        $this->user = new User();
        $this->customer = new Customer();
        $this->dog = new Dog();
        $this->reservation = new Reservation();
    }

    /**
     * Populate class with user data, customer data, dog data, and reservation data from ReservationID
     *
     * @return void
     */
    public function GetPrintData() {

        // Get reservation by ID
        $this->_reservationData = $this->reservation->getReservationData();

        // Get Customer by res->CustId

        // Get Dog Data by res->DogId
    }

    public function reservationData() {
        return $this->_reservationData;

    }


}


