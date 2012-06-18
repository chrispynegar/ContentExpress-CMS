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
	 
	 public function message($tags = '<div id="system-message">|</div>	') {
		 if(isset($_SESSION['message']) && !empty($_SESSION['message'])) {
		 	if(isset($tags) && !empty($tags)) {
			 	$tag = explode('|', $tags);
			 	echo $tag[0].$_SESSION['message'].$tag[1];
			 	unset($_SESSION['message']);
			 	return;
		 	} else {
				echo $_SESSION['message']; unset($_SESSION['message']);
				return;	
		 	}
		 }
	 }
	 
	 /**
	 * URL Format
	 *
	 * Formats a string for a url making it all lowercase and replaceing the spaces with the selected seperator
	 *
	 * @access public
	 * @return string
	 */
	 
	 public function url_format($str, $sep = '-') {
		 $str = strtolower($str);
		 $str = str_replace(' ', $sep, $str);
		 return $str;
	 }
	 
	 public function show_404() {
		 ob_start();
		 require(SITE_ROOT.'errors/404.php');
		 $view = ob_get_clean();
		 echo $view;
		 exit;
	 }
	
}

$system = new System();

?>