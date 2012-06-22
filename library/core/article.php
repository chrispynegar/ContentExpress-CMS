<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The core Article class
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class Article extends Core {

	protected static $table_name = 'articles';
	protected static $table_fields = array('id', 'author', 'category', 'name', 'alias', 'content', 'published', 'hits', 'tags', 'keywords', 'description', 'comments', 'sharing', 'published', 'date_modified', 'date_created');
	public $id;
	public $author;
	public $category;
	public $name;
	public $alias;
	public $content;
	public $published;
	public $hits;
	public $tags;
	public $keywords;
	public $description;
	public $comments;
	public $sharing;
	public $date_modified;
	public $date_created;
	
	/**
     * Saves a Article
     * 
     * Saves an article, if it has an ID it will update the record with that ID otherwise it will create a new article.
     * 
     * @access public
     * @param array
     * @param int
     * @param string
     * @return boolean 
     */
	
	public function save_article($data = null, $article_id = null, $redirect = null) {
		global $database;
		global $session;
		global $system;
		global $validation;
		
		$this->author = $session->user_id;
		$this->category = trim((isset($data) && is_array($data) ? $data['category'] : $_POST['category']));
		$this->name = trim((isset($data) && is_array($data) ? $data['name'] : $_POST['name']));
		$this->content = trim((isset($data) && is_array($data) ? $data['content'] : $_POST['content']));
		$this->published = trim((isset($data) && is_array($data) ? $data['published'] : $_POST['published']));
		$this->tags = trim((isset($data) && is_array($data) ? $data['tags'] : $_POST['tags']));
		$this->keywords = trim((isset($data) && is_array($data) ? $data['keywords'] : $_POST['keywords']));
		$this->description = trim((isset($data) && is_array($data) ? $data['description'] : $_POST['description']));
		$this->comments = trim((isset($data) && is_array($data) ? $data['comments'] : $_POST['comments']));
		$this->sharing = trim((isset($data) && is_array($data) ? $data['sharing'] : $_POST['sharing']));
		
		$this->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
		
		if(is_numeric($article_id)) {
	        $stored_data = self::find_by_id($article_id);
	        $this->id = $article_id;
	        $this->alias = $stored_data->alias;
	        $this->hits = $stored_data->hits;
	        $this->date_created = $stored_data->date_created;
        } else {
        	$this->hits = 0;
	        $this->date_created = $this->date_modified;
        }
        
        if($validation->required($this->name) && $validation->required($this->content)) {
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
	        	$session->message('This article was successfully saved.');
		        if(isset($redirect) && !empty($redirect)) {
			        $system->redirect($redirect);
		        } else {
		        	if(!isset($stored_data)) {
			        	$new_article = $this->find('alias', $this->alias);
			        	if($new_article) {
				        	$system->redirect('article-editor.php?id='.$new_article->id);
			        	}
		        	} else {
			        	return true;
		        	}
		        }
	        } else {
		        $session->message('This article could not be saved.');
		        return false;
	        }
        } else {
	        $session->message('Please fill in the required fields.');
	        return false;
        }
	}

}

?>