<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core Comment class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class Comment extends Core {

	protected static $table_name = 'comments';
	protected static $table_fields = array('id', 'user_id', 'article_id', 'photo_id', 'name', 'email', 'url', 'comment', 'likes', 'dislikes', 'status', 'code', 'date_moderated', 'date_created');
	public $id;
	public $user_id;
	public $article_id;
	public $photo_id;
	public $name;
	public $email;
	public $url;
	public $comment;
	public $likes;
	public $dislikes;
	public $status;
	public $code;
	public $date_moderated;
	public $date_created;
	
	/**
     * Retrieves an items comments
     * 
     * Saves a comment, if it has an ID it will update the record with that ID otherwise it will create a new comment.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
	
	public function get_comments($type, $id, $limit = false) {
		if($type == 'article') {
			$type = 'article_id';
		} elseif($type == 'photo') {
			$type = 'photo_id';
		}
		return static::find_by_sql('SELECT * FROM '.DB_TBL_PREFIX.static::$table_name.' WHERE '.$type.'='.$id);
	}
	
	/**
     * Saves a Comment
     * 
     * Saves a comment, if it has an ID it will update the record with that ID otherwise it will create a new comment.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
	
	public function save_comment($data = null, $type = 'article', $comment_id = null, $redirect = null) {
		global $database;
    	global $session;
    	global $system;
    	global $validation;
    	
    	if(!$session->is_logged_in()) {
	    	$this->name = trim((isset($data) && is_array($data) ? $data['name'] : $_POST['name']));
	    	$this->email = trim((isset($data) && is_array($data) ? $data['email'] : $_POST['email']));
	    	$this->url = trim((isset($data) && is_array($data) ? $data['url'] : $_POST['url']));
    	} else {
	    	$this->user_id = trim((isset($data) && is_array($data) ? $data['user_id'] : $_POST['user_id']));
    	}
    	if($type == 'article') {
	    	$this->article_id = trim((isset($data) && is_array($data) ? $data['article_id'] : $_POST['article_id']));
    	} elseif($type == 'photo') {
	    	$this->photo_id = trim((isset($data) && is_array($data) ? $data['photo_id'] : $_POST['photo_id']));
    	}
    	$this->comment = trim((isset($data) && is_array($data) ? $data['comment'] : $_POST['comment']));
    	
    	if(is_numeric($comment_id)) {
	        $stored_data = self::find_by_id($comment_id);
	        $this->id = $comment_id;
	        $this->likes = $stored_data->likes;
	        $this->dislikes = $stored_data->likes;
	        $this->status = $stored_data->status;
	        $this->code = $stored_data->code;
	        $this->date_created = $stored_data->date_created;
        } else {
        	$this->likes = 0;
        	$this->dislikes = 0;
        	$this->status = 'pending';
	        $this->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
	        $this->code = substr(md5(date('U').$this->comment), 0, 16);
        }
        
        if(!$session->is_logged_in()) {
	        if(!$validation->required($this->name) && !$validation->required($this->email)) {
		        $session->message('You must fill in the required fields');
		        return false;
	        }
        }
        if($validation->required($this->comment)) {
	        if($this->save()) {
	        	$session->message('This comment was successfully saved.');
		        if(isset($redirect) && !empty($redirect)) {
			        $system->redirect($redirect);
		        } else {
		        	if(!isset($stored_data)) {
			        	$new_comment = $this->find('code', $this->code);
			        	if($new_comment) {
				        	$system->redirect('comment-editor.php?id='.$new_comment->id);
			        	}
		        	} else {
			        	return true;
		        	}
		        }
	        } else {
		        $session->message('This comment could not be saved.');
		        return false;
	        }
        } else {
	        $session->message('You must fill in the required fields');
	        return false;
        }
	}

}

?>