<?php
class Reservation {
    private $_db,
            $_data,
            $_session,
            $_cookie;

    public function __construct($reservation = null) { 
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get("session/session_name");
        $this->_cookieName = Config::get("remember/cookie_name");
    }

    public function create($fields) {
        $uid = $this->_data->uid;
    }
}