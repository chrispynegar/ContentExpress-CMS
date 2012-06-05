<?php

/**
 * User manager
 *
 * The management screen for managing users.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(4);

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$per_page = 10;

$total_count = User::count_all();

$pagination = new Pagination($page, $per_page, $total_count);

$users = User::select_paginated($per_page);

$title = 'User Manager';

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<form class="search-form" action="#" method="post">
		<label for="search">Search</label>
		<input type="text" name="search" id="search" value="" />
		<a href="#" class="submit">Go</a>
	</form>
	<a href="./user-editor.php" class="toolbar-button" title="Add"><img src="../library/icons/add.png" alt="Add icon" /> Add</a>
</div>
<div class="main-column">
	<table>
		<tr class="table-header">
			<th>ID</th>
			<th>Access</th>
			<th>Username</th>
			<th>Active</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($users as $user): ?>
		<tr>
			<td><?php echo $user->id; ?></td>
			<?php $permission = Permission::find_by_id($user->permission); ?>
			<td><?php echo $permission->name; ?></td>
			<td><?php echo $user->username; ?></td>
			<td><span class="<?php echo ($user->active == 1 ? 'published">Yes' : 'not-published">No'); ?></span></td>
			<td><a href="./user-editor.php?id=<?php echo htmlentities($user->id); ?>" title="Edit <?php echo $user->username; ?>">Edit</a></td>
			<td><a href="./user-delete.php?id=<?php echo htmlentities($user->id); ?>" title="Delete <?php echo $user->username; ?>" class="delete-alert">Delete</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php $pagination->display('user-manager.php', $page); ?>
</div>

<div class="modal-content delete-alert-dialog" title="Warning">
    <p>Are you sure you want to delete this user?</p>
</div>

<?php require(ADMIN_TEMPLATE_FOOTER); ?>