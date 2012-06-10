<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core Menu class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class MenuItem extends Core {

	protected static $table_name = 'menu_items';
	protected static $table_fields = array('id', 'menu', 'type', 'title', 'alias', 'position', 'options', 'active', 'date_modified', 'date_created');
	public $id;
	public $menu;
	public $type;
	public $title;
	public $alias;
	public $position;
	public $options;
	public $active;
	public $date_modified;
	public $date_created;
	
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
	
	/**
     * Find menu items
     * 
     * Finds all menu items
     * 
     * @access public
     * @return array 
     */
     
     public static function find_menu_items($menu_id) {
	     return static::find_by_sql('SELECT * FROM ' . DB_TBL_PREFIX . static::$table_name . ' WHERE menu="' . $menu_id . '" ORDER BY id ASC');
     }
     
     /**
     * Count menu items
     * 
     * Count menu items from a menu
     * 
     * @access public
     * @return array 
     */
     
     public static function count_menu_items($menu_id) {
	 	global $database;
	 	$sql = 'SELECT COUNT(*) FROM ' . DB_TBL_PREFIX . static::$table_name . ' WHERE menu="' . $menu_id . '"';
	 	$result = $database->query($sql);
	 	$row = $database->fetch_array($result);
	 	return array_shift($row);
     }
     
     /**
     * Select Paginated
     *
     * Returns the paginated rows
     *
     * @access public
     * @param int
     * @return array
     */
    
    public static function select_paginated_items($per_page, $menu_id) {
	    global $pagination;
	    $sql = 'SELECT * FROM '.DB_TBL_PREFIX.static::$table_name.' WHERE menu="'.$menu_id.'" LIMIT '.$per_page.' OFFSET '.$pagination->offset();
	    return static::find_by_sql($sql);
    }

}

?>