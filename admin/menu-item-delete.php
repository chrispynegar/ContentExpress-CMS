<?php

/**
 * Menu Item delete
 *
 * Script for deleting menu item permanently.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(8);

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	if($_GET['id'] == 1 && $_GET['menu'] == 1) {
		$session->message('You cannot delete the default menu item.');
	} else {
		$menu_item = MenuItem::find_by_id($_GET['id']);
		if($menu_item->delete()) {
			$session->message('This menu item was successfully deleted.');
		} else {
			$session->message('This menu item could not be deleted.');
		}
	}	
} else {
	$session->message('No menu item was selected.');
}

$system->redirect('menu-item-manager.php?menu='.$_GET['menu'].'&type='.$_GET['type']);

?>