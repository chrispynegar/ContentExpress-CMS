<?php

/**
 * Menu delete
 *
 * Script for deleting menus permanently.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(8);

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	if($_GET['id'] == 1) {
		$session->message('You cannot delete the default menu.');
	} else {
		$menu = Menu::find_by_id($_GET['id']);
		if($menu->delete()) {
			$session->message('This menu was successfully deleted.');
		} else {
			$session->message('This menu could not be deleted.');
		}
	}	
} else {
	$session->message('No menu was selected.');
}

$system->redirect('menu-manager.php');

?>