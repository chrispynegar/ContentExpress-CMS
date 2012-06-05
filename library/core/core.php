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
        $class_name = get_called_class();
        $object = new $class_name;
        foreach($record as $attribute => $value) {
            if($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
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
        return static::find_by_sql('SELECT * FROM ' . DB_TBL_PREFIX . static::$table_name . ' ORDER BY id ASC');
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
        global $database;
        $result_array = static::find_by_sql('SELECT * FROM ' . DB_TBL_PREFIX . static::$table_name . ' WHERE id=.' . $id . ' LIMIT 1');
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
        global $database;
        $result_array = static::find_by_sql('SELECT * FROM ' . DB_TBL_PREFIX . static::$table_name . ' WHERE id=1 LIMIT 1');
        return !empty($result_array) ? array_shift($result_array) : false;
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
        global $database;
        $result = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result)) {
            $object_array[] = static::instantiate($row);
        }
        $_SESSION['last_sql'] = $sql;
        return $object_array;
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
        global $database;
        $sql = 'SELECT COUNT(*) FROM ' . DB_TBL_PREFIX . static::$table_name;
        $result = $database->query($sql);
        $row = $database->fetch_array($result);
        return array_shift($row);
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
        global $database;
        $sql = 'SELECT COUNT(*) FROM ' . DB_TBL_PREFIX . static::$table_name . ' WHERE ' . $field . '=' . $value;
        $result = $database->query($sql);
        $row = $database->fetch_array($result);
        return array_shift($row);
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
        $object_vars = get_object_vars($this);
        return array_key_exists($attribute, $object_vars);
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
        $attributes = array();
        foreach(static::$table_fields as $field) {
            if(property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
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
        global $database;
        $clean_attributes = array();
        foreach($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
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
        return static::$table_name;
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
        global $database;
        $attributes = $this->sanitized_attributes();
        $sql = 'INSERT INTO ' . DB_TBL_PREFIX . static::$table_name . ' (';
        $sql .= join(', ', array_keys($attributes));
        $sql .= ') VALUES (\'';
        $sql .= join('\', \'', array_values($attributes));
        $sql .= '\')';
        if($database->query($sql)) {
            $this->id - $database->insert_id();
            $_SESSION['last_sql'] = $sql;
            return true;
        } else {
            $_SESSION['last_sql'] = $sql;
            return false;
        }
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
        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key} = '{$value}'";
        }
        $sql = 'UPDATE ' . DB_TBL_PREFIX . static::$table_name . ' SET ';
        $sql .= join(', ', $attribute_pairs);
        $sql .= ' WHERE id=' . $database->escape_value($this->id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }
    
    /**
     * Delete
     * 
     * Deletes a record
     * 
     * @access public
     * @return boolean 
     */
    
    public function delete() {
        global $database;
        $sql = 'DELETE FROM ' . DB_TBL_PREFIX . static::$table_name;
        $sql .= ' WHERE id=' . $database->escape_value($this->id);
        $sql .= ' LIMIT 1';
        $database->query($sql);
        $_SESSION['last_sql'] = $sql;
        return ($database->affected_rows() == 1) ? true : false;
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
        return isset($this->id) ? $this->update() : $this->create();
    }


}

?>
