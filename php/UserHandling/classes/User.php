<?php
class User {
    private $_db,
            $_data,
            $_sessionName,
            $_isLoggedIn; 

    public function __construct($user = null) {
        $this->_db = DB::getInstance();

        $this->_sessionName = Config::get('session/session_name');

        // check if user logged in
        if(!$user) {
            if(Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
                
                if($this->find($user)) {
                    $this->_isLoggedIn = true;
                } else {
                    // process logout
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function create($fields) {
        if (!$this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating an account.');
        }
    }

    public function find($user = null) {
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('users', array($field, '=', $user));

            if($data->count() > 0) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    /**
     * Log a user in and initiate a session.
     * 
     * @param mixed $username
     * @param mixed $password
     * @return bool
     */
    public function login($username = null, $password = null) {
        
        $user = $this->find($username);

        if($user) {
            if($this->data()->password === Hash::make($password, $this->data()->salt)) {
                echo 'OK!';
                print_r($this->_data);
                Session::put($this->_sessionName, $this->data()->id); // use ID to set a session
                return true;

            }
        }
        return false;
    }

    /**
     * Summary of update
     * @param mixed $fields - The fields that need to be updated
     * @param mixed $id - [optional] user ID for user that admin wants to update
     * @return void
     */
    public function update($fields = array(), $id = null) { // id is optional to update a different user's profile as an administrator
        
        if(!$id && $this->isLoggedIn()) { // If no id provided, update current user
            $id = $this->data()->id;
        }

        if(!$this->_db->update('users', $id, $fields)) { // if ID provided, update provided user that matches id
            throw new Exception('There was a problem updating this user.');
        }
        
    }

    public function logout() {
        Session::delete($this->_sessionName);
    }

    public function data() {
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }
}