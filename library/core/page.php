<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core Page class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class Page extends Core {

	protected static $table_name = 'pages';
	protected static $table_fields = array('id', 'author', 'title', 'alias', 'content', 'keywords', 'description', 'published', 'date_modified', 'date_created');
	public $id;
	public $author;
	public $title;
	public $alias;
	public $content;
	public $keywords;
	public $description;
	public $published;
	public $date_modified;
	public $date_created;
	
	/**
     * Saves a page
     * 
     * Saves a page, if it has an ID it will update the record with that ID otherwise it will create a new page.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
	
	public function save_page($data = null, $page_id = null, $redirect = null) {
		global $database;
    	global $session;
    	global $system;
    	global $validation;
    	
    	$this->author = $session->user_id;
    	$this->title = trim((isset($data) && is_array($data) ? $data['title'] : $_POST['title']));
    	$this->content = trim((isset($data) && is_array($data) ? $data['content'] : $_POST['content']));
		$this->keywords = trim((isset($data) && is_array($data) ? $data['keywords'] : $_POST['keywords']));
		$this->description = trim((isset($data) && is_array($data) ? $data['description'] : $_POST['description']));
		$this->published = trim((isset($data) && is_array($data) ? $data['published'] : $_POST['published']));
		
		$this->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
        
        if(is_numeric($page_id)) {
	        $stored_data = self::find_by_id($page_id);
	        $this->id = $page_id;
	        $this->alias = $stored_data->alias;
	        $this->date_created = $stored_data->date_created;
        } else {
	        $this->date_created = $this->date_modified;
        }
        
        if($validation->required($this->title) && $validation->required($this->content)) {
        	if(!isset($stored_data)) {
        		$this->alias = $system->url_format($this->title);
	        	if($this->find('alias', $this->alias)) {
	        		$append = 1;
		        	while($this->find('alias', $this->alias)) {
			        	$this->alias = $system->url_format($this->title).'-'.$append;
			        	$append++;
		        	}
	        	}
        	}
	        if($this->save()) {
	        	$session->message('This page was successfully saved.');
		        if(isset($redirect) && !empty($redirect)) {
			        $system->redirect($redirect);
		        } else {
		        	if(!isset($stored_data)) {
			        	$new_page = $this->find('title', $this->title);
			        	if($new_page) {
				        	$system->redirect('page-editor.php?id='.$new_page->id);
			        	}
		        	} else {
			        	return true;
		        	}
		        }
	        } else {
		        $session->message('This page could not be saved.');
		        return false;
	        }
        } else {
	        $session->message('Please fill in the required fields.');
        }
	}

}

?>