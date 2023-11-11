<?php
class Reservation {
    private $_db;

    private $customerId,
            $dogId,
            $startTime,
            $endTime,
            $reservationType;


    public function __construct($customerId) {
        $this->_db = DB::getInstance();
        $this->customerId = $customerId;
        $this->reservationType = 'boarding';

    }

    /**
     * @param mixed $startTime - when the dropoff time is
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @param mixed $endTime - pickup time
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
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