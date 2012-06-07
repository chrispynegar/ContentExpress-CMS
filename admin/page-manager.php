<?php

/**
 * Page manager
 *
 * The management screen for managing pages.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(4);

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$per_page = 10;

$total_count = Page::count_all();

$pagination = new Pagination($page, $per_page, $total_count);

$pages = Page::select_paginated($per_page);

$title = 'Page Manager';

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<form class="search-form" action="#" method="post">
		<label for="search">Search</label>
		<input type="text" name="search" id="search" value="" />
		<a href="#" class="submit">Go</a>
	</form>
	<a href="./page-editor.php" class="toolbar-button" title="Add"><img src="../library/icons/add.png" alt="Add icon" /> Add</a>
</div>
<div class="main-column">
	<?php if($total_count > 0): ?>
	<table>
		<tr class="table-header">
			<th>ID</th>
			<th>Username</th>
			<th>Active</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($pages as $page): ?>
		<tr>
			<td><?php echo $page->id; ?></td>
			<td><?php echo $page->title; ?></td>
			<td><span class="<?php echo ($page->active == 1 ? 'published">Yes' : 'not-published">No'); ?></span></td>
			<td><a href="./page-editor.php?id=<?php echo htmlentities($page->id); ?>" title="Edit <?php echo $page->title; ?>">Edit</a></td>
			<td><a href="./page-delete.php?id=<?php echo htmlentities($page->id); ?>" title="Delete <?php echo $page->title; ?>" class="delete-alert">Delete</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p>There are no pages to display.</p>
	<?php endif; ?>
	<?php $pagination->display('page-manager.php', $page); ?>
</div>

<div class="modal-content delete-alert-dialog" title="Warning">
    <p>Are you sure you want to delete this page?</p>
</div>

<?php require(ADMIN_TEMPLATE_FOOTER); ?>