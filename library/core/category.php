<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core Category class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class Category extends Core {

	protected static $table_name = 'categories';
	protected static $table_fields = array('id', 'parent', 'author', 'name', 'alias', 'type', 'active', 'description', 'active', 'date_modified', 'date_created');
	public $id;
	public $parent;
	public $author;
	public $name;
	public $alias;
	public $type;
	public $active;
	public $description;
	public $date_modified;
	public $date_created;
	
	/**
	 * Get all active
	 *
	 * Gets all the active categories for specific types or all of them
	 *
	 * @access public
	 * @param string
	 * @return array
	*/
	
	public static function get_all_active($type) {
		if(isset($type) && !empty($type)) {
			$type = ' OR WHERE type="'.$type.'" ';
		} else {
			$type = '';
		}
		return static::find_by_sql('SELECT * FROM ' . DB_TBL_PREFIX . static::$table_name . ' WHERE type="all"'.$type);
	}
	
	
	/**
     * Saves a Category
     * 
     * Saves a Category, if it has an ID it will update the record with that ID otherwise it will create a new category.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
	
	public function save_category($data = null, $category_id = null, $redirect = null) {
		
	}

}

?>