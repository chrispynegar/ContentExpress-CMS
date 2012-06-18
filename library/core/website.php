<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core Website class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

class Website extends Core {

	public $content;
	
	public function main_menu() {
		$menu = Menu::find_by_id(1);
		$items = MenuItem::find_menu_items($menu->id);
		ob_start();
		include(SITE_ROOT.'components/com_menu/system-output.php');
		$view = ob_get_clean();
		echo $view;
	}
	
	public function content() {
		echo $this->content;
	}
	
}

$website = new Website();

?>