<?php

/**
 * Dashboard
 *
 * The dashboard the user see's when they login
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(4);

$title = 'Dashboard';

require(ADMIN_TEMPLATE_HEADER);

?>

<?php $system->message(); ?>

<?php require(ADMIN_TEMPLATE_FOOTER);