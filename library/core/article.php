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
	protected static $table_fields = array('id', 'author', 'category', 'name', 'alias', 'content', 'active', 'hits', 'tags', 'keywords', 'description', 'comments', 'sharing', 'active', 'date_modified', 'date_created');
	public $id;
	public $author;
	public $category;
	public $name;
	public $alias;
	public $content;
	public $active;
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
		
	}

}

?>