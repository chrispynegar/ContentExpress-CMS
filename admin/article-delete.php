<?php

/**
 * Article delete
 *
 * Script for deleting articles permanently.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(8);

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$article = Article::find_by_id($_GET['id']);
	if($article->delete()) {
		$session->message('This article was successfully deleted.');
	} else {
		$session->message('This article could not be deleted.');
	}	
} else {
	$session->message('No article was selected.');
}

$system->redirect('article-manager.php');

?>