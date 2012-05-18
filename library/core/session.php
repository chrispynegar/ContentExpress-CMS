<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * Handles the system sessions
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class session {
    
    private $logged_in = false;
    public $message;
    public $user_id;
    public $user_username;
    
    public function __construct() {
        session_start();
        $this->check_login();
    }
    
    /**
     * Is logged in
     * 
     * Checks that the user is logged in
     * 
     * @access public
     * @return boolean 
     */
    
    public function is_logged_in() {
        return $this->logged_in;
    }
    
    /**
     * Login
     * 
     * Logs in a user
     * 
     * @access public
     * @param array
     * @return boolean 
     */
    
    public function login($user) {
        if($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->user_username = $_SESSION['user_username'] = $user->username;
            $this->logged_in = true;
        }
    }
    
    /**
     * Logout
     * 
     * Logs out a user by unsetting the user session data
     * 
     * @access public
     * @return void 
     */
    
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($this->user_id);
        unset($this->user_username);
        $this->loggin_in = false;
    }
    
    /**
     * Message
     * 
     * If the message session variable is set it outputs it otherwise it is used to set another
     * 
     * @access public
     * @param string
     * @return string 
     */
    
    public function message($msg = '') {
        if(!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }
    
    /**
     * Check login
     * 
     * Checks that the user session variables are set
     * 
     * @access private
     * @return boolean 
     */
    
    private function check_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }
    
}

$session = new session();

?>
