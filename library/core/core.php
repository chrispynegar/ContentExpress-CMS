<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The system's core CRUD
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */
class Core {
    
    protected static $table_name;
    
    /**
     * Instantiate record
     * 
     * Check that the record exists
     * 
     * @access public
     * $param array
     * @return array 
     */
    
    public function instantiate($record) {
        
    }
    
    /**
     * Find all
     * 
     * Finds all records in the table
     * 
     * @access public
     * @return array 
     */
    
    public function find_all() {
        
    }
    
    /**
     * Find by ID
     * 
     * Finds a record by the passed ID
     * 
     * @access public
     * @param integer
     * @return array 
     */
    
    public static function find_by_id($id = 0) {
        
    }
    
    /**
     * Find default
     * 
     * Finds the record that has an ID of 1 and returns it if it exists.
     * 
     * @access public
     * @return array 
     */
    
    public static function find_default() {
        
    }
    
    /**
     * Find by SQL
     * 
     * Find a record by an SQL Query
     * 
     * @access public
     * @param string
     * @return array 
     */
    
    public static function find_by_sql($sql) {
        
    }
    
    /**
     * Count all
     * 
     * Counts all records in a table.
     * 
     * @access public
     * @return integer 
     */
    
    public static function count_all() {
        
    }
    
    /**
     * Count Specific
     * 
     * Counts all records that have a specific value in a specific field
     * 
     * @access public
     * @param string
     * @param string
     * @return integer 
     */
    
    public static function count_specific($field, $value) {
        
    }
    
    /**
     * Has Attribute
     * 
     * Checks that an array key exists
     * 
     * @access private
     * @param array
     * @return boolean 
     */
    
    private function has_attribute($attribute) {
        
    }
    
    /**
     * Attributes
     * 
     * Return an array of attribute names and their values
     * 
     * @access protected
     * @return array 
     */
    
    protected function attributes() {
        
    }
    
    /**
     * Sanitized Attributes
     * 
     * Sanitizes the attributes before they are submitted
     * 
     * @access protected
     * @return array 
     */
    
    protected function sanitized_attributes() {
        
    }
    
    /**
     * Get table name
     * 
     * Returns the name of the table
     * 
     * @access public
     * @return string 
     */
    
    public static function get_table_name() {
        
    }
    
    /**
     * Create
     * 
     * Creates a new record
     * 
     * @access public
     * @return boolean 
     */
    
    public function create() {
        
    }
    
    /**
     * Update
     * 
     * Updates an existing record
     * 
     * @access public
     * @return boolean 
     */
    
    public function update() {
        
    }
    
    /**
     * Save
     * 
     * Saves a record
     * 
     * @access public
     * @return void 
     */
    
    public function save() {
        
    }


}

?>
