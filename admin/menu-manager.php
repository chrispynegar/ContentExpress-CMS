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

$total_count = Menu::count_all();

$pagination = new Pagination($page, $per_page, $total_count);

$menus = Menu::select_paginated($per_page);

$title = 'Menu Manager';

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<form class="search-form" action="#" method="post">
		<label for="search">Search</label>
		<input type="text" name="search" id="search" value="" />
		<a href="#" class="submit">Go</a>
	</form>
	<a href="./menu-editor.php" class="toolbar-button" title="Add"><img src="../library/icons/add.png" alt="Add icon" /> Add</a>
</div>
<div class="main-column">
	<?php if($total_count > 0): ?>
	<table>
		<tr class="table-header">
			<th>ID</th>
			<th>Name</th>
			<th>Published</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($menus as $menu): ?>
		<tr>
			<td><?php echo $menu->id; ?></td>
			<td><?php echo $menu->name; ?></td>
			<td><span class="<?php echo ($menu->published == 1 ? 'published">Yes' : 'not-published">No'); ?></span></td>
			<td><a href="./menu-item-manager.php?menu=<?php echo htmlentities($menu->id); ?>" title="<?php echo $menu->name; ?> Items">Manage Items</a></td>
			<td><a href="./menu-editor.php?id=<?php echo htmlentities($menu->id); ?>" title="Edit <?php echo $menu->name; ?>">Edit</a></td>
			<td><a href="./menu-delete.php?id=<?php echo htmlentities($menu->id); ?>" title="Delete <?php echo $menu->name; ?>" class="delete-alert">Delete</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p class="no-results">There are no menus to display.</p>
	<?php endif; ?>
	<?php $pagination->display('menu-manager.php', $page); ?>
</div>

<div class="modal-content delete-alert-dialog" title="Warning">
    <p>Are you sure you want to delete this menu?</p>
</div>

<?php require(ADMIN_TEMPLATE_FOOTER); ?>