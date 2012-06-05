<?php

/**
 * User editor
 *
 * Visual for creating and editing users.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(8);

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$user = User::find_by_id($_GET['id']);
	if($user->id == 1) {
		$session->message('You cannot delete the default user.');
	} else {
		if($user->delete()) {
			$session->message('This user was successfully deleted.');
		} else {
			$session->message('This user could not be deleted.');
		}
	}
} else {
	$session->message('No user was selected.');
}

$system->redirect('user-manager.php');

?>