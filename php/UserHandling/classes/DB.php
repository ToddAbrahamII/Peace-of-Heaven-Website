<?php

// DB wrapper to handle SQL queries and open an instance of the database.
class DB {
    private static $_instance = null;
    private $_pdo, 
            $_query,
            $_lastQuery, 
            $_error = false, 
            $_results, 
            $_count = 0;
    
        

    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'),Config::get('mysql/username'), Config::get('mysql/password'));

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    // First check if instance already exists so we keep from inefficient db access
    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array()) {
        $this->_error = false; // make sure not returning previous query error
        if($this->_query = $this->_pdo->prepare($sql)) { // if prepare is successful
            $x=1;
            if(count($params)) { // check if parameters are set
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param); 
                    $x++;
                }
            }

            if($this->_query->execute()) { // If query executes succesfuly then store results
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();

                $this->_lastQuery = $sql;
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    /**
     * Debugging helper that returns the last query executed on this instance
     * @return mixed
     */
    public function getLastQuery() {
        return $this->_lastQuery;
    }

  

    /**
     * Reusable select method from db
     * Calls action() and passes to action to query the DB
     * @param mixed $table
     * @param mixed $where
     * @return DB
     */
    public function get($table, $where) {
        return $this->action('SELECT *', $table, $where);
    }

    /**
     * Summary of update
     * @param mixed $table - table we want to update
     * @param mixed $id -  of row we need to update
     * @param mixed $fields - fields we want to update
     * @return bool
     */
    public function update ($table, $id, $fields) {
        $set = '';
        $x =1;

        // set
        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count($fields)) { // if not at end of fields array, add a comma.
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id} ";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }
    /**
     * returns the list of results from query
     * @return mixed
     */
    public function results() {
        return $this->_results;
    }   

    /**
     * Return the first result from the query
     * @return mixed
     */
    public function first() {
        return $this->results()[0];
    }

    /**
     * Reusable Delete method from db
     * Calls action() and passes to action to query
     * @param mixed $table
     * @param mixed $where 
     * @return DB
     */
    public function delete($table, $where) {
        return $this->action('DELETE', $table, $where);

    }

  /**
     * Constructs a query
     * && CalledBy
     * @calls $this->query();
     * @calledBy $this->
     * @group Accessor Group
     * 
     * @param mixed $action [ex. SELECT,UPDATE,DELETE]
     * @param mixed $table = DB table
     * @param mixed $where 
     * @return static
     */
    private function action ($action, $table, $where = array()) { // 
        if(count($where) === 3) { // Ensure array is filled
            $operators = array('=','>','<','<=','>=');

            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql,array($value))->error()) {
                    return $this;
                }
            } 
        }
        return false;
    }
    /**
     * Summary of insert
     * @param mixed $table
     * @param mixed $fields
     * @return bool
     */
    public function insert ($table, $fields = array()) {
        if(count($fields)) {

            $keys = array_keys($fields);
            $values = null; //keep track of '?'s
            $x = 1;

            foreach($fields as $field) {
                $values .= '?';
                if($x < count($fields)) { // If not at end of field, add a comma > "?, ?, ?"
                    $values .= ', ';
                }
                $x++;
            }

            // Creates a comma delimited insert statement. For examle: SELECT * FROM users (`name`,`pass`)
            $sql = "INSERT INTO {$table} (`" . implode('`,`',$keys) . "`) VALUES ({$values})"; // https://www.youtube.com/watch?v=FCnZsU19jyo&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=10
            
            if(!$this->query($sql, $fields)->error()) {
                return true;
            }

        }
        return false;
    }

    /**
     * counts the number of rows returned from query
     * @return int|mixed 
     */
    public function count() {
        return $this->_count;
    }
    /**
     * Summary of error
     * @return bool
     */
    public function error() {
        return $this->_error;
    }

    ####### Transaction Handling ############
    // Useful for when we need to update multiple tables at once. If any statement fails, it rolls back any changes
    //   within the transaction

    public function  beginTransaction() {
        return $this->_pdo->beginTransaction();
    }

    public function commit() {
        return $this->_pdo->commit();
    }

    public function rollBack() {
        
    }

    /**
     * Summary of update with choice to change id 
     * @param mixed $table - table we want to update
     * @param mixed $id -  of row we need to update
     * @param mixed $fields - fields we want to update
     * @return bool
     */
    public function updateWithID ($table, $id, $idcolumn, $fields) {
        $set = '';
        $x =1;

        // set
        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count($fields)) { // if not at end of fields array, add a comma.
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE {$idcolumn} = {$id} ";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }
}