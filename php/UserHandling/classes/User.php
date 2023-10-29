<?php
class User {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn; 

    public function __construct($user = null) {
        $this->_db = DB::getInstance();

        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

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

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    /**
     * Log a user in and initiate a session.
     * 
     * @param mixed $username
     * @param mixed $password
     * @param mixed $remember = rememberMe checkbox status
     * @return bool
     */
    public function login($username = null, $password = null, $remember = null) {
        
        $user = $this->find($username);

        if($user) {
            if($this->data()->password === Hash::make($password, $this->data()->salt)) {
                
                Session::put($this->_sessionName, $this->data()->id); // use ID to set a session
            ###### Remember me handler for user form. Comment out if depracated #####
                if($remember) {
                    $hash = Hash::unique(); // generate a unique hash
                    $hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

                    if(!$hashCheck->count()) {
                        $this->_db->insert('users', array(
                            'user_id' => $this->data()->id,
                            'hash' => $hash
                        ));

                    } else {
                        $hash = $hashCheck->first()->hash;
                    }
                    
                    Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));

                }
            ########## END remember me handler #####################
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

    public function hasPermission ($key) {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->group));
        
        if($group->count()) {
           $permissions = json_decode($group->first()->permissions, true);
           
           if($permissions[$key]) {
                return true;
           }
        }
        return false;
    }

    /**
     * Deletes session name to logout user
     * @return void
     */
    public function logout() {
        Session::delete($this->_sessionName);
    }

    /**
     * Helper returns private data variables
     * @return mixed
     */
    public function data() {
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }
}