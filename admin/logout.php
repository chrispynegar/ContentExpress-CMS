<?php

/**
 * Logout
 *
 * Logs out the currently logged in user
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) {
	$session->message('You are already logged out.');
} else {
	$session->logout();
	$session->message('You are now logged out.');
}

$system->redirect('login.php');

?>