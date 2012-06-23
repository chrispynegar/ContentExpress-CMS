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
	protected static $table_fields = array('id', 'user_id', 'article_id', 'photo_id', 'name', 'email', 'url', 'comment', 'likes', 'dislikes', 'status', 'date_moderated', 'date_created');
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
	public $date_moderated;
	public $date_created;
	
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
	
	public function save_comment($data = null, $type = 'article', $type_id = null, $redirect = null) {
		
	}

}

?>