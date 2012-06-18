<?php

/**
 * The website output
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('library/load.php');

// load website class
require(SITE_ROOT.'library/core/website.php');

if(isset($_GET['item'])) {
	if($item = MenuItem::find_by_alias($_GET['item'])) {
		$type = MenuType::find_by_id($item->type);
		ob_start();
		include(SITE_ROOT.'components/'.$type->directory.'/menu-output.php');
		$website->content = ob_get_clean();
	} else {
		$system->show_404();
	}
}

$public_template = Template::public_template();

require(SITE_ROOT.'templates/'.$public_template->directory.'/index.php');

?>