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

$users = User::find_all();

$title = 'User Manager';

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
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
			<td><a href="./user-editor.php?id=<?php echo $user->id; ?>" title="Edit <?php echo $user->username; ?>">Edit</a></td>
			<td><a href="#" title="Delete <?php echo $user->username; ?>">Delete</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<?php require(ADMIN_TEMPLATE_FOOTER); ?>