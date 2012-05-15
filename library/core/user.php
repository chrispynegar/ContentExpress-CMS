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
        
    }
    
    /**
     * Saves a user
     * 
     * Saves a user, if it has an ID it will update the record with that ID otherwise it will create a new user.
     * 
     * @access public
     * @param array
     * @param string
     * @return boolean 
     */
    
    public function save_user($data = null, $redirect = null) {
        
    }
    
}

?>
