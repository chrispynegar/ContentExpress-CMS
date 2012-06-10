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

if(isset($_GET['menu']) && is_numeric($_GET['menu'])) {
	$menu = Menu::find_by_id($_GET['menu']);
}

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$per_page = 10;

$total_count = MenuItem::count_menu_items($menu->id);

$pagination = new Pagination($page, $per_page, $total_count);

$menu_items = MenuItem::select_paginated_items($per_page, $menu->id);

$title = 'Menu Manager: '.$menu->name;

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<form class="search-form" action="#" method="post">
		<label for="search">Search</label>
		<input type="text" name="search" id="search" value="" />
		<a href="#" class="submit">Go</a>
	</form>
	<a href="#" class="toolbar-button activate-selection-modal" title="Add"><img src="../library/icons/add.png" alt="Add icon" /> Add</a>
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
		<?php foreach($menu_items as $item): ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->title; ?></td>
			<td><span class="<?php echo ($item->active == 1 ? 'published">Yes' : 'not-published">No'); ?></span></td>
			<td><a href="./menu-item-editor.php?menu=<?php echo htmlentities($menu->id); ?>&amp;type=<?php echo htmlentities($item->type); ?>&amp;id=<?php echo htmlentities($item->id); ?>" title="Edit <?php echo $item->title; ?>">Edit</a></td>
			<td><a href="./menu-item-delete.php?menu=<?php echo htmlentities($menu->id); ?>&amp;type=<?php echo htmlentities($item->type); ?>&amp;id=<?php echo htmlentities($item->id); ?>" title="Delete <?php echo $item->title; ?>" class="delete-alert">Delete</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p class="no-results">There are no menu items to display.</p>
	<?php endif; ?>
	<?php $pagination->display('menu-item-manager.php?menu'.$menu->id, $page); ?>
</div>

<div class="modal-content selection-modal" title="">
	<?php $types = MenuType::find_all(); ?>
	<ul class="selection-list">
		<?php foreach($types as $type): ?>
		<li><a href="./menu-item-editor.php?menu=<?php echo htmlentities($menu->id); ?>&amp;type=<?php echo htmlentities($type->id); ?>"><?php echo $type->name; ?></a></li>
		<?php endforeach;?>
	</ul>
</div>

<div class="modal-content delete-alert-dialog" title="Warning">
    <p>Are you sure you want to delete this item?</p>
</div>

<?php require(ADMIN_TEMPLATE_FOOTER); ?>