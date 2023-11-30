<?php

class Announcement {
    private $_db,
            $_announcementData,
            $_sessionName;


    /**
     * Connects to the db
     */
    public function __construct() {
        $this->_db = DB::getInstance(); // Retrieve database instance

        $this->_sessionName = Config::get('session/session_name'); // Retrieve Session variable

    }

    /**
     * Creates announcement row in the database 
     */
    public function create($fields) {
        $uid = Session::get(Config::get('session/session_name'));
        print_r($uid);

        if (!$this->_db->insert('announcements', $fields)) {
            throw new Exception('There was a problem adding your info.');
        }
    }

    /**
     * Gets all announcements
     */
    public function getAnnouncements(){
            //Gathers all data as a string
         $data = $this->_db->get('announcements', array(1, '=', 1));

         if($data->count() > 0) {
             //Takes all data, sorts into an array so it can be printed in rows
             $this->_announcementData = $data->results();
             return true;
         }else{
             return false;
         }
    }

     /**
      * Gets all announcments with an age <= 5 
      */
      public function postAnnouncements() {
        $data = $this->_db->get('announcements', array('age', '<=', 5));

        if($data->count() > 0) {
            //Takes all data, sorts into an array so it can be printed in rows
            $this->_announcementData = $data->results();
            return true;
        }else{
            return false;
        }

    }
        
      /** 
     * Updates announcement table
    */
    public function update( $fields, $key, $keyValue) {

        if(!$this->_db->updateTable('announcements', $fields, $key, $keyValue)) { // if ID provided, update provided user that matches id
            throw new Exception('There was a problem updating this user.');
        }
        return true;
    }

      /**
     * Gets all announcements with ID
     */
    public function getAnnouncementsWithID($announcement){
        //Gathers all data as a string
     $data = $this->_db->get('announcements', array('id', '=', $announcement));

     if($data->count() > 0) {
         //Takes all data, sorts into an array so it can be printed in rows
         $this->_announcementData = $data->first();
         return true;
     }else{
         return false;
     }
}


       /**
     * Returns data for kennel
     */
    public function data(){
        return $this->_announcementData;
    }






}