<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core Album class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class Album extends Core {

	protected static $table_name = 'albums';
	protected static $table_fields = array('id', 'user_id', 'cover', 'name', 'description', 'active', 'date_modified', 'date_created');
	public $id;
	public $user_id;
	public $cover;
	public $name;
	public $description;
	public $active;
	public $date_modified;
	public $date_created;
	
	/**
     * Saves an Album
     * 
     * Saves an Album, if it has an ID it will update the record with that ID otherwise it will create a new album.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
	
	public function save_album($data = null, $album_id = null, $redirect = null) {
		
	}

}

?>