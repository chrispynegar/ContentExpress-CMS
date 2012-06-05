<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * Validation helper
 *
 * Handles form validation
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

class Validation {

	/**
	 * Required
	 *
	 * Checks that the required string is valid
	 *
	 * @access public
	 * @param string
	 * @return string
	 */
	public function required($str) {
		if(isset($str) && !empty($str)) {
			return $str;
		}
	}
	
	/**
	 * Username
	 *
	 * Checks that the string is a valid username
	 *
	 * @access public
	 * @param string
	 * @return string
	 */
	public function username($str) {
		return preg_match('/^[A-Z0-9]{3,20}$/i', $str);
	}
	
	/**
	 * Email
	 *
	 * Checks that the string is a valid email address
	 *
	 * @access public
	 * @param string
	 * @return string
	 */
	public function email($str) {
		return filter_var($str, FILTER_VALIDATE_EMAIL);
	}
	
	/**
	 * Url
	 *
	 * Checks that the string is a valid url
	 *
	 * @access public
	 * @param string
	 * @return boolean
	 */
	public function url($str) {
		return filter_var($str, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
	}
	
	public function matches($str1, $str2) {
		if($str1 == $str2) {
			return true;
		}
	}
	
	public function identical($str1, $str2) {
		if($str1 === $str2) {
			return true;
		}
	}

}

$validation = new Validation();

?>