<?php

/**
 * Profile
 *
 * The view for a user profile.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(4);

if(isset($_GET['id'])) {
	$user = User::find_by_id($_GET['id']);
} else {
	$session->message('User not found.');
	redirect('user-manager.php');
}

$title = 'Profile: '.$user->fullname();

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<a href="#" class="toolbar-button" title="Albums"><img src="../library/icons/folder_full.png" alt="Album icon" /> Albums</a>
	<a href="./user-edit.php?id=<?php echo htmlentities($_GET['id']); ?>" class="toolbar-button" title="Edit"><img src="../library/icons/user.png" alt="User icon" /> Edit</a>
</div>

<?php require(ADMIN_TEMPLATE_FOOTER); ?>