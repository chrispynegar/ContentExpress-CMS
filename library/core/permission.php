<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * Handles user permissions
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
 
class Permission extends Core {
	
	protected static $table_name = 'permissions';
	protected static $table_fields = array('id', 'name', 'access');
	public $id;
	public $name;
	public $access;
	
	/**
	 * Access
	 *
	 * Checks user has permission to access requested section
	 *
	 * @param int
	 * @param int
	 * @return boolean
	 */
	public static function access($access, $permission_id = null) {
		global $session;
		if(!empty($permission_id)) {
			$permission = Permission::find_by_id($permission_id);
		} elseif(isset($session->user_id)) {
			$user = User::find_by_id($session->user_id);
			if($user) {
				$permission = Permission::find_by_id($user->permission);
			} else {
				die('Could not find user.');
			}
		} else {
			die('No valid access passed to function');
		}
		if($permission->access < $access) {
			die('You do not have permission to access this area.');
		} else {
			return true;
		}
	}
}

?>