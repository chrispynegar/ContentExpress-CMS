<?php

/**
 * Page delete
 *
 * Script for deleting pages permanently.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(8);

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$page = Page::find_by_id($_GET['id']);
	if($page->delete()) {
		$session->message('This page was successfully deleted.');
	} else {
		$session->message('This page could not be deleted.');
	}	
} else {
	$session->message('No Page was selected.');
}

$system->redirect('page-manager.php');

?>