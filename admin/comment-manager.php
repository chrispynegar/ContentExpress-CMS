<?php

/**
 * Comment manager
 *
 * The management screen for managing comments.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(4);

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$per_page = 10;

$total_count = Comment::count_all();

$pagination = new Pagination($page, $per_page, $total_count);

$comments = Comment::select_paginated($per_page);

$title = 'Comment Manager';

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<form class="search-form" action="#" method="post">
		<label for="search">Search</label>
		<input type="text" name="search" id="search" value="" />
		<a href="#" class="submit">Go</a>
	</form>
	<a href="./comment-editor.php" class="toolbar-button" title="Add"><img src="../library/icons/add.png" alt="Add icon" /> Add</a>
	<a href="#" class="toolbar-button" title="Settings"><img src="../library/icons/process.png" alt="Settings icon" /> Settings</a>
	<a href="#" class="toolbar-button" title="Help"><img src="../library/icons/help.png" alt="Help icon" /> Help</a>
</div>
<div class="main-column">
	<?php if($total_count > 0): ?>
	<table>
		<tr class="table-header">
			<th>ID</th>
			<th>Name</th>
			<th>Status</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($comments as $comment): ?>
		<tr>
			<td><?php echo $comment->id; ?></td>
			<?php
				if(isset($comment->user_id) && !empty($comment->user_id)) {
					$user = User::find_by_id($comment->user_id);
					$name = $user->fullname();
				} else {
					$name = $comment->name;
				}
			?>
			<td><?php echo $name; ?></td>
			<td><?php echo ucwords($comment->status); ?></td>
			<td><a href="./comment-editor.php?id=<?php echo htmlentities($comment->id); ?>" title="Edit">Edit</a></td>
			<td><a href="./comment-delete.php?id=<?php echo htmlentities($comment->id); ?>" title="Delete" class="delete-alert">Delete</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p class="no-results">There are no pages to display.</p>
	<?php endif; ?>
	<?php $pagination->display('comment-manager.php', $page); ?>
</div>

<div class="modal-content delete-alert-dialog" title="Warning">
    <p>Are you sure you want to delete this page?</p>
</div>

<?php require(ADMIN_TEMPLATE_FOOTER); ?>