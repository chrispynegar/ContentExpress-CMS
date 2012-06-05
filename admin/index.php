<?php

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(4);

$title = 'Dashboard';

require(ADMIN_TEMPLATE_HEADER);

?>



<?php require(ADMIN_TEMPLATE_FOOTER);