<?php

/**
 * User editor
 *
 * Visual for creating and editing users.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(4);

if(isset($_GET['menu'])) {
	$menu = Menu::find_by_id($_GET['menu']);
}

if(isset($_GET['type'])) {
	$type = MenuType::find_by_id($_GET['type']);
}

if(isset($_GET['id'])) {
	$item = MenuItem::find_by_id($_GET['id']);
}

if(isset($_POST['submit_form']) && $_POST['submit_form'] == 'accept') {
	if(isset($item->id)) {
		$item->save_item(null, $item->id, 'menu-item-manager.php?menu='.$menu->id);
	} else {
		$item = new MenuItem();
		$item->save_item(null, null, 'menu-item-manager.php?menu='.$menu->id);
	}
} elseif(isset($_POST['submit_form']) && $_POST['submit_form'] == 'save') {
	if(isset($item->id)) {
		$item->save_item(null, $page->id, 'menu-item-manager.php?menu='.$menu->id);
	} else {
		$item = new MenuItem();
		$item->save_item();
	}
}

require(SITE_ROOT.'library/helpers/component_helper.php');
require(SITE_ROOT.'components/'.$type->directory.'/controller.php');

$title = (isset($item->id) ? 'Edit' : 'Create').' Menu Item';

$scripts = array('editor');

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<a href="#" class="toolbar-button accept" title="Accept"><img src="../library/icons/accept_page.png" alt="Accept page icon" /> Accept</a>
	<a href="#" class="toolbar-button save" title="Save"><img src="../library/icons/accept.png" alt="Accept icon" /> Save</a>
	<a href="#" class="toolbar-button" title="Help"><img src="../library/icons/help.png" alt="Help icon" /> Help</a>
</div>
<form action="page-editor.php<?php echo (isset($page->id) ? '?id='.htmlentities($page->id) : ''); ?>" method="post" class="editor-form" id="editor">
	<div class="left-column">
		<label for="title">Title</label>
		<input type="text" name="title" id="title" value="<?php echo (isset($_POST['title']) ? $_POST['title'] : (isset($item->title) ? $item->title : '')); ?>" />
		<?php $component->build_form_fields($com['menu']); ?>
	</div>
	<div class="right-column">
		<div class="accordion">
			<h3><a href="#">Information</a></h3>
			<div>
				<p>Current Status:</p>
				<p><?php echo (isset($item->active) && $item->active == 1 ? 'Active' : 'Not active' ); ?></p>
				<?php if(isset($item->date_modified) && $item->date_modified !== $item->date_created): ?>
				<p>Date Modified:</p>
				<p><?php echo $item->date_modified; ?></p>
				<?php endif; ?>
				<p>Date Created:</p>
				<p><?php echo (isset($item->date_created) ? $item->date_created : 'Not yet created'); ?></p>
			</div>
			<h3><a href="#">Settings</a></h3>
			<div>
				<label for="active">Menu Item Active</label>
				<div class="buttonset">
					<input type="radio" name="active" id="active1" value="0"<?php echo (isset($item->active) && $item->active == 0 ? ' checked="checked"' : ''); ?> /><label for="active1">No</label>
					<input type="radio" name="active" id="active2" value="1"<?php echo (isset($item->active) && $item->active == 1 ? ' checked="checked"' : (!isset($item->active) ? ' checked="checked"' : '')); ?> /><label for="active2">Yes</label>
				</div>
			</div>
		</div>
	</div>
</form>

<?php require(ADMIN_TEMPLATE_FOOTER);