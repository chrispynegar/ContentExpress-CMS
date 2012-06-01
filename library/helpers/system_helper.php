<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * System helper
 *
 * Handles various system specific tasks
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

class System {
	
	/**
	 * Redirect
	 *
	 * Redirects to another page
	 *
	 * @param string
	 * @return void
	 */
	public function redirect($location) {
		if(!empty($location)) {
			header('Location: '.$location);
			exit;
		}
	}
	
	/**
	 * Message
	 *
	 * Outputs a the message if $_SESSION['message']
	 *
	 * @access public
	 * @return string
	 */
	 public function message() {
		 if(isset($_SESSION['message']) && !empty($_SESSION['message'])) {
			 echo $_SESSION['message']; unset($_SESSION['message']);
			 return;
		 }
	 }
	
}

$system = new System();

?>