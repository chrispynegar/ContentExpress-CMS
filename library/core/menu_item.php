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
    
    /**
     * Saves an item
     * 
     * Saves a menu item, if it has an ID it will update the record with that ID otherwise it will create a new menu item.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
	
	public function save_item($menu_id, $type_id, $type_directory, $data = null, $item_id = null, $redirect = null) {
		global $database;
		global $session;
		global $system;
		global $validation;
		
		$this->menu = $menu_id;
		$this->type = $type_id;
		$this->title = trim((isset($data) && is_array($data) ? $data['title'] : $_POST['title']));
		$alias = trim((isset($data) && is_array($data) ? $data['alias'] : $_POST['alias']));
		$this->alias = $system->url_format($alias);
		$this->active = trim((isset($data) && is_array($data) ? $data['active'] : $_POST['active']));
		
		require(SITE_ROOT.'components/'.$type_directory.'/menu-save.php');
		
		$this->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
		
		if(is_numeric($item_id)) {
			$stored_data = self::find_by_id($item_id);
	        $this->id = $item_id;
	        $this->position = $stored_data->position;
	        $this->date_created = $stored_data->date_created;
		} else {
			$item_count = static::count_menu_items($menu_id);
			$this->position = $item_count + 1;
			$this->date_created = $this->date_modified;
		}
		
		if($validation->required($this->title) && $validation->required($this->alias)) {
			$append = 1;
        	while($this->find('alias', $this->alias)) {
	        	$this->alias = $this->alias.'-'.$append;
	        	$append++;
        	}
        	if($this->save()) {
	        	$session->message('This item was successfully saved.');
		        if(isset($redirect) && !empty($redirect)) {
			        $system->redirect($redirect);
		        } else {
		        	if(!isset($stored_data)) {
			        	$new_item = $this->find('alias', $this->alias);
			        	if($new_item) {
				        	$system->redirect('menu-item-editor.php?menu='.$menu_id.'&type='.$type_id.'id='.$new_item->id);
			        	}
		        	} else {
			        	return true;
		        	}
		        }
	        } else {
		        $session->message('This item could not be saved.');
		        return false;
	        }
		} else {
			$session->message('Please fill in the required fields.');
			return false;
		}
	}

}

?>