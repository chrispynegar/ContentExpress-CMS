<?php

/**
 * The template class to handle the system templates
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

class Template extends Core {
    
    protected static $table_name = 'templates';
    protected static $table_fields = array('id', 'type', 'name', 'directory', 'current', 'options', 'date_installed');
    public $id;
    public $type;
    public $name;
    public $directory;
    public $current;
    public $options;
    public $date_installed;
    
    /**
     * Admin template
     * 
     * Finds the current admin template
     * 
     * @access public
     * @return array
     */
    
    public static function admin_template() {
        global $database;
        $result_array = self::find_by_sql('SELECT * FROM ' . DB_TBL_PREFIX . static::$table_name . ' WHERE type="admin" AND current="1" LIMIT 1');
        return (!empty($result_array) ? array_shift($result_array) : false);
    }
    
}

?>
