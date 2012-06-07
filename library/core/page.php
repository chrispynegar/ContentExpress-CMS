<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core Page class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class User extends Core {

	protected static $table_name = 'pages';
	protected static $table_fields = array('id', 'author', 'title', 'content', 'keywords', 'description', 'published', 'date_modified', 'date_created');
	public $id;
	public $author;
	public $title;
	public $content;
	public $keywords;
	public $description;
	public $published;
	public $date_modified;
	public $date_created;
	
	/**
     * Saves a page
     * 
     * Saves a page, if it has an ID it will update the record with that ID otherwise it will create a new page.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
	
	public function save_page($data = null, $page_id = null, $redirect = null) {
		global $database;
    	global $session;
    	global $system;
    	global $validation;
	}

}

?>