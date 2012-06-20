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

// load required helpers
$helpers = array('system', 'validation', 'pagination');
foreach($helpers as $helper) {
	if(file_exists(SITE_ROOT.'library/helpers/'.$helper.'.php')) {
		require(SITE_ROOT.'library/helpers/'.$helper.'.php');
	} elseif(file_exists(SITE_ROOT.'library/helpers/'.$helper.'_helper.php')) {
		require(SITE_ROOT.'library/helpers/'.$helper.'_helper.php');
	}
}

// load database class
require(SITE_ROOT.'library/core/database.php');

// load session session class
require(SITE_ROOT.'library/core/session.php');

// load core system crud
require(SITE_ROOT.'library/core/core.php');

// load core libraries
$libraries = array('user', 'permission', 'template', 'page', 'menu', 'menu_type', 'menu_item', 'category', 'article');
foreach($libraries as $library) {
    require(SITE_ROOT.'library/core/'.$library.'.php');
}

$admin_template = Template::admin_template();

define('ADMIN_TEMPLATE', SITE_ROOT.'templates/'.$admin_template->directory.'/');
define('ADMIN_TEMPLATE_HEADER', ADMIN_TEMPLATE.'header.php');
define('ADMIN_TEMPLATE_FOOTER', ADMIN_TEMPLATE.'footer.php');

?>