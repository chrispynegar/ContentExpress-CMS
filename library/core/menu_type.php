<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core Menu class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class MenuType extends Core {

	protected static $table_name = 'menu_types';
	protected static $table_fields = array('id', 'name', 'alias', 'directory', 'active', 'date_installed');
	public $id;
	public $name;
	public $alias;
	public $directory;
	public $active;
	public $date_installed;
	
	/**
     * Find all active
     * 
     * Finds all records in the table that are active
     * 
     * @access public
     * @return array 
     */
	
	public static function find_all_active() {
		return static::find_by_sql('SELECT * FROM ' . DB_TBL_PREFIX . static::$table_name . ' WHERE active="1" ORDER BY id ASC');
	}

}

?>