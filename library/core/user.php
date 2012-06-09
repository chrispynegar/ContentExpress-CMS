<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core User class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class User extends Core {
    
    protected static $table_name = 'users';
    protected static $table_fields = array('id' , 'permission', 'username', 'password', 'email', 'first_name', 'last_name', 'active', 'url', 'bio', 'date_modified', 'date_created');
    public $id;
    public $permission;
    public $username;
    public $password;
    public $email;
    public $first_name;
    public $last_name;
    public $active;
    public $url;
    public $bio;
    public $date_modified;
    public $date_created;
    
    /**
     * Full name
     * 
     * Gets the full name of the user
     * 
     * @access public
     * @return string 
     */
    
    public function fullname() {
        if(isset($this->first_name) && isset($this->last_name)) {
	        return $this->first_name.' '.$this->last_name;
        } else {
	        return null;
        }
    }
    
    /**
     * Authenticate user
     * 
     * Authenticate a user if their username and password are matched in the database
     * 
     * @access public
     * @param string
     * @param string
     * @return array 
     */
    
    public function authenticate($username = '', $password = '') {
        global $database;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);
        $hashed_password = sha1($password);
        $sql = 'SELECT id, username, password FROM ' . DB_TBL_PREFIX.self::$table_name;
        $sql .= ' WHERE username = \''.$username.'\' AND password = \''.$hashed_password.'\' LIMIT 1';
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false; 
    }
    
    /**
     * Saves a user
     * 
     * Saves a user, if it has an ID it will update the record with that ID otherwise it will create a new user.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
    
    public function save_user($data = null, $user_id = null, $redirect = null) {
    	global $database;
    	global $session;
    	global $system;
    	global $validation;
        
        $this->permission = trim((isset($data) && is_array($data) ? $data['permission'] : $_POST['permission']));
        $this->username = trim((isset($data) && is_array($data) ? $data['username'] : $_POST['username']));
        $this->email = trim((isset($data) && is_array($data) ? $data['email'] : $_POST['email']));
        $this->first_name = trim((isset($data) && is_array($data) ? $data['first_name'] : $_POST['first_name']));
        $this->last_name = trim((isset($data) && is_array($data) ? $data['last_name'] : $_POST['last_name']));
        $this->active = trim((isset($data) && is_array($data) ? $data['active'] : $_POST['active']));
        $this->url = trim((isset($data) && is_array($data) ? $data['url'] : $_POST['url']));
        $this->bio = trim((isset($data) && is_array($data) ? $data['bio'] : $_POST['bio']));
        $password = trim((isset($data) && is_array($data) ? $data['password'] : $_POST['password']));
        $password2 = trim((isset($data) && is_array($data) ? $data['password2'] : $_POST['password2']));
        
        $this->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
        if(is_numeric($user_id)) {
	        $stored_data = self::find_by_id($user_id);
	        $this->id = $user_id;
	        $this->date_created = $stored_data->date_created;
        } else {
	        $this->date_created = $this->date_modified;
        }
        if($validation->required($this->username) && $validation->required($this->email)) {
        	if(isset($stored_data)) {
	        	if(isset($password) && !empty($password) && isset($password2) && !empty($password2)) {
		        	if(!$validation->identical($password, $password2)) {
				        $session->message('Your passwords do not match.');
				        return false;
			        } else {
				        $this->password = sha1($password);
			        }
	        	}
        	} else {
	        	if($validation->required($password) && $validation->required($password2)) {
	        		if(!$validation->identical($password, $password2)) {
				        $session->message('Your passwords do not match.');
				        return false;
			        } else {
				        $this->password = sha1($password);
			        }
	        	} else {
		        	$session->message('Passwords are required');
		        	return false;
	        	}
        	}
	        if(!$validation->username($this->username)) {
		        $session->message('Please enter a valid username.');
		        return false;
	        } else {
		        if(isset($stored_data)) {
			        if($stored_data->username !== $this->username) {
				        if($this->find('username', $this->username)) {
					        $session->message('This username already exists.');
					        return false;
				        }
			        }
		        } else {
			        if($this->find('username', $this->username)) {
				        $session->message('This username already exists, please choose another.');
				        return false;
			        }
		        }
	        }
	        if(!$validation->email($this->email)) {
		        $session->message('Please enter a valid email address.');
		        return false;
	        }
	        if(isset($this->url) && !empty($this->url)) {
		        if(!$validation->url($this->url)) {
			        $session->message('You must enter a valid url.');
			        return false;
		        }
	        }
	        if($this->save()) {
	        	$session->message('This user was successfully saved.');
		        if(isset($redirect) && !empty($redirect)) {
			        $system->redirect($redirect);
		        } else {
		        	if(!isset($stored_data)) {
			        	$new_user = $this->find('username', $this->username);
			        	if($new_user) {
				        	$system->redirect('user-editor.php?id='.$new_user->id);
			        	}
		        	} else {
			        	return true;
		        	}
		        }
	        } else {
		        $session->message('This user could not be saved.');
		        return false;
	        }
        } else {
	        $session->message('Please fill in the required fields.');
	        return false;
        }
    }
    
}

?>
