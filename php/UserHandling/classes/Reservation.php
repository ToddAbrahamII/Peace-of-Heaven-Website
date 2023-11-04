<?php
class Reservation {
    private $_db,
            $_reservationData,
            $_sessionName,
            $_cookieName;

    public function __construct($reservation = null) { 
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get("session/session_name");
        $this->_cookieName = Config::get("remember/cookie_name");
    }

    /**
     * Summary of createReservation
     * @param mixed $fields
     * @throws \Exception
     * @return void
     */
    public function createReservation($fields) {

        if (!$this->_db->insert('reservation', $fields)) {
            throw new Exception('There was a problem creating a reservation');
        }
    }
    
    public function getCustomerReservation() {

    }

    /**
     * Query the database to get a Reservation.
     * If parameter is provided, returns only one reservation
     * @param mixed $reservationId 
     * @return bool
     */
    public function getReservation($reservationId=null) { // retrieve reservation info from DB
        if($reservationId) {
            $field = $reservationId;
            $data = $this->_db->get('reservation', array($field, '=', $reservationId));

            if($data->count() > 0) {
                $this->_reservationData = $data->first();
                return true;
            }
        } 
        return false;
    }

    public function updateReservation($fields=array(), $dogId) {

    }
    public function deleteReservation($reservationId) {
       // delete from table_name where field = ?;
        // Not implemented in DB yet
    }
}