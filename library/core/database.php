<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The system loader
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

class Database {
    
    private $connection;
    private $magic_quotes_active;
    private $real_escape_string_exists;
    public $last_query;
    
    public function __construct() {
        $this->open_connection();
        $this->magic_quotes_active = get_magic_quotes_gpc();
        $this->real_escape_string_exists = function_exists('mysql_real_escape_string');
    }
    
    /**
     * Open Connection
     * 
     * Opens a new database connection
     * @access public
     * @return boolean 
     */
    
    public function open_connection() {
        $this->connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        if(!$this->connection) {
            die('MySQL connection failed: ' . mysql_error());
        } else {
            $db_select = mysql_select_db(DB_NAME, $this->connection);
            if(!$db_select) {
                die('Database connection failed: ' . mysql_error());
            }
        }
    }
    
    /**
     * Close conection
     * 
     * Closes the database connection
     * 
     * @access public
     * @return @void 
     */
    
    public function close_connection() {
        if(isset($this->connection)) {
            mysql_close();
            unset($this->connection);
        }
    }
    
    /**
     * Escape value
     * 
     * Escapes values for database
     * 
     * @access public
     * @return array
     */
    
    public function escape_value($value) {
        if($this->real_escape_string_exists) {
            if($this->magic_quotes_active) {
                $value = stripslashes($value);
            }
            $value = mysql_real_escape_string($value);
        } else {
            if(!$this->magic_quotes_active) {
                $value = addslashes($value);
            }
        }
        return $value;
    }
    
    /**
     * Query
     * 
     * Executes a new database query
     * 
     * @access public
     * @return boolean 
     */
    
    public function query($sql) {
        $this->last_query = $sql;
        $result = mysql_query($sql, $this->connection);
        $this->confirm_query($result);
        return $result;
    }
    
    /**
     * Confirm query
     * 
     * Confirms a valid database query
     * 
     * @access private
     * @return void 
     */
    
    private function confirm_query($result) {
        if(!$result) {
            $output = 'Database query failed: ' . mysql_error() . '<br /><br />';
            $output .= 'Last SQL query: ' . $this->last_query;
            die($output);
        }
    }
    
    /**
     * Fetch array
     * 
     * The fetch_array database function
     * 
     * @access public
     * @return array 
     */
    
    public function fetch_array($result) {
        return mysql_fetch_array($result);
    }
    
    /**
     * Free result
     * 
     * The free result database function
     * 
     * @access public
     * @return array 
     */
    
    public function free_result($result) {
        return mysql_free_result($result);
    }
    
    /**
     * Num rows
     * 
     * Return the number of rows in the query
     * 
     * @access public
     * @return boolean 
     */
    
    public function num_rows($result) {
        return mysql_num_rows($result);
    }
    
    /**
     * Affected Rows
     * 
     * Gets the number of affected rows
     * 
     * @access public
     * @return integer
     */
    
    public function affected_rows() {
        return mysql_affected_rows($this->connection);
    }
    
    /**
     * Insert ID
     * 
     * Return the auto incremented ID created for the last query
     * 
     * @access public
     * @return integer
     */
    
    public function insert_id() {
        return mysql_insert_id($this->connection);
    }
    
}

$database = new Database();

?>
