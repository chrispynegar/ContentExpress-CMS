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
	
}

$system = new System();

?>