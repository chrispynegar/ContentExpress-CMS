<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * The system loader
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

// find correct path to config file
if(file_exists('config.php')) {
    require('config.php');
} elseif(file_exists('../config.php')) {
    require('../config.php');
} elseif(file_exists('../../config.php')) {
    require('../../config.php');
} elseif(file_exists('../../../config.php')) {
    require('../../../config.php');
} elseif(file_exists('../../../../config.php')) {
    require('../../../../config.php');
}

// create constants from the config arrays
foreach($config as $key => $value) {
    define(strtoupper($key), $value);
}

// load database class


// load core class


// load core libraries


?>