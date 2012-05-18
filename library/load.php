<?php

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
require(SITE_ROOT.'library/core/database.php');

// load session session class
require(SITE_ROOT.'library/core/session.php');

// load core system crud
require(SITE_ROOT.'library/core/core.php');

// load core libraries



?>