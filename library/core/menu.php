<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core Menu class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class Menu extends Core {

	protected static $table_name = 'menus';
	protected static $table_fields = array('id', 'name', 'alias', 'description', 'published', 'date_modified', 'date_created');
	public $id;
	public $name;
	public $alias;
	public $description;
	public $published;
	public $date_modified;
	public $date_created;
	
	/**
     * Saves a menu
     * 
     * Saves a menu, if it has an ID it will update the record with that ID otherwise it will create a new menu.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
	
	public function save_menu($data = null, $menu_id = null, $redirect = null) {
		global $database;
    	global $session;
    	global $system;
    	global $validation;
    	
    	$this->name = trim((isset($data) && is_array($data) ? $data['name'] : $_POST['name']));
		$this->description = trim((isset($data) && is_array($data) ? $data['description'] : $_POST['description']));
		$this->published = trim((isset($data) && is_array($data) ? $data['published'] : $_POST['published']));
		
		$this->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
        
        if(is_numeric($menu_id)) {
	        $stored_data = self::find_by_id($menu_id);
	        $this->id = $menu_id;
	        $this->alias = $stored_data->alias;
	        $this->date_created = $stored_data->date_created;
        } else {
	        $this->date_created = $this->date_modified;
        }
        
        if($validation->required($this->name)) {
        	if(!isset($stored_data)) {
        		$this->alias = $system->url_format($this->name);
	        	if($this->find('alias', $this->alias)) {
	        		$append = 1;
		        	while($this->find('alias', $this->alias)) {
			        	$this->alias = $system->url_format($this->name).'-'.$append;
			        	$append++;
		        	}
	        	}
        	}
	        if($this->save()) {
	        	$session->message('This menu was successfully saved.');
		        if(isset($redirect) && !empty($redirect)) {
			        $system->redirect($redirect);
		        } else {
		        	if(!isset($stored_data)) {
			        	$new_menu = $this->find('alias', $this->alias);
			        	if($new_menu) {
				        	$system->redirect('menu-editor.php?id='.$new_menu->id);
			        	}
		        	} else {
			        	return true;
		        	}
		        }
	        } else {
		        $session->message('This menu could not be saved.');
		        return false;
	        }
        } else {
	        $session->message('Please fill in the required fields.');
        }
	}

}

?>