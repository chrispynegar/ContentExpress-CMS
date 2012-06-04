<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core User class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class User extends Core {
    
    protected static $table_name = 'users';
    protected static $table_fields = array('id' , 'permission', 'username', 'password', 'email', 'first_name', 'last_name', 'active', 'url', 'bio', 'date_modified', 'date_created');
    public $id;
    public $permission;
    public $username;
    public $password;
    public $email;
    public $first_name;
    public $last_name;
    public $active;
    public $url;
    public $bio;
    public $date_modified;
    public $date_created;
    
    /**
     * Full name
     * 
     * Gets the full name of the user
     * 
     * @access public
     * @return string 
     */
    
    public function fullname() {
        
    }
    
    /**
     * Authenticate user
     * 
     * Authenticate a user if their username and password are matched in the database
     * 
     * @access public
     * @param string
     * @param string
     * @return array 
     */
    
    public function authenticate($username = '', $password = '') {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);
        $hashed_password = sha1($password);
        $sql = 'SELECT id, username, password FROM ' . DB_TBL_PREFIX.self::$table_name;
        $sql .= ' WHERE username = \''.$username.'\' AND password = \''.$hashed_password.'\' LIMIT 1';
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false; 
    }
    
    /**
     * Find by username
     * 
     * Search the database for a record with a username that matches the one passed to the function and return the array if a match is found
     * 
     * @access public
     * @param string
     * @return array
     */
    
    public function find_by_username($username = '') {
        global $database;
        $result_array = self::find_by_sql('SELECR * FROM ' . DB_TBL_PREFIX . self::$table_name . 'WHERE username="' . $username . '" LIMIT 1');
        return (!empty($result_array) ? array_shift($result_array) : false);
    }
    
    /**
     * Find by email
     * 
     * Search the database for a record with an email address that matches the one passed to the function and return the array if a match is found
     * 
     * @access public
     * @param string
     * @return array
     */
    
    public function find_by_email($email = '') {
        global $database;
        $result_array = self::find_by_sql('SELECR * FROM ' . DB_TBL_PREFIX . self::$table_name . 'WHERE email="' . $email . '" LIMIT 1');
        return (!empty($result_array) ? array_shift($result_array) : false);
    }
    
    /**
     * Saves a user
     * 
     * Saves a user, if it has an ID it will update the record with that ID otherwise it will create a new user.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
    
    public function save_user($data = null, $user_id = null, $redirect = null) {
        if(isset($data) && is_array($data)) {
	        
        } else {
	        $this->permission = $_POST['permission'];
	        $this->username = $_POST['username'];
	        $this->password = $_POST['password'];
	        $this->email = $_POST['email'];
	        $this->first_name = $_POST['first_name'];
	        $this->last_name = $_POST['last_name'];
	        $this->active = $_POST['active'];
	        $this->url = $_POST['url'];
	        $this->bio = $_POST['bio'];
	        $this->date_modified = $_POST['date_modified'];
	        $this->date_created = $_POST['date_created'];
        }
    }
    
}

?>
