<?php
class Reservation {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName;

    public function __construct($reservation = null) { 
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get("session/session_name");
        $this->_cookieName = Config::get("remember/cookie_name");
    }

    public function createReservation($fields) {

        if (!$this->_db->insert('reservation', $fields)) {
            throw new Exception('There was a problem creating a reservation');
        }
    }

    public function getReservation($id) {
        $reservation = $this->_db->get('reservation', $id);
    }

    public function updateReservation($fields=array(), $dogId) {
        
    }
    public function deleteReservation($id) {
       // delete from table_name where field = ?;
        // Not implemented in DB yet
    }
}