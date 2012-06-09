<?php

/**
 * Menu editor
 *
 * Visual for creating and editing menus.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(4);

if(isset($_GET['id'])) {
	$menu = Menu::find_by_id($_GET['id']);
}

if(isset($_POST['submit_form']) && $_POST['submit_form'] == 'accept') {
	if(isset($menu->id)) {
		$menu->save_menu(null, $menu->id, 'menu-manager.php');
	} else {
		$menu = new Menu();
		$menu->save_menu(null, null, 'menu-manager.php');
	}
} elseif(isset($_POST['submit_form']) && $_POST['submit_form'] == 'save') {
	if(isset($menu->id)) {
		$menu->save_menu(null, $page->id, 'menu-manager.php');
	} else {
		$menu = new Menu();
		$menu->save_menu();
	}
}

$title = (isset($menu->id) ? 'Edit' : 'Create').' Menu';

$scripts = array('editor');

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<a href="#" class="toolbar-button accept" title="Accept"><img src="../library/icons/accept_page.png" alt="Accept page icon" /> Accept</a>
	<a href="#" class="toolbar-button save" title="Save"><img src="../library/icons/accept.png" alt="Accept icon" /> Save</a>
	<a href="#" class="toolbar-button" title="Help"><img src="../library/icons/help.png" alt="Help icon" /> Help</a>
</div>
<form action="menu-editor.php<?php echo (isset($menu->id) ? '?id='.htmlentities($menu->id) : ''); ?>" method="post" class="editor-form" id="editor">
	<div class="left-column">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" value="<?php echo (isset($_POST['name']) ? $_POST['name'] : (isset($menu->name) ? $menu->name : '')); ?>" />
		<label for="description">Description</label>
		<textarea name="description" id="description" class="editor"><?php echo (isset($_POST['description']) ? $_POST['description'] : (isset($menu->description) ? $menu->description : '')); ?></textarea>
	</div>
	<div class="right-column">
		<div class="accordion">
			<h3><a href="#">Information</a></h3>
			<div>
				<p>Current Status:</p>
				<p><?php echo (isset($menu->published) && $menu->published == 1 ? 'Published' : 'Not published' ); ?></p>
				<?php if(isset($menu->date_modified) && $menu->date_modified !== $menu->date_created): ?>
				<p>Date Modified:</p>
				<p><?php echo $menu->date_modified; ?></p>
				<?php endif; ?>
				<p>Date Created:</p>
				<p><?php echo (isset($menu->date_created) ? $menu->date_created : 'Not yet created'); ?></p>
			</div>
			<h3><a href="#">Settings</a></h3>
			<div>
				<label for="published">Menu Published</label>
				<div class="buttonset">
					<input type="radio" name="published" id="published1" value="0"<?php echo (isset($menu->published) && $menu->published == 0 ? ' checked="checked"' : ''); ?> /><label for="published1">No</label>
					<input type="radio" name="published" id="published2" value="1"<?php echo (isset($menu->published) && $menu->published == 1 ? ' checked="checked"' : (!isset($menu->published) ? ' checked="checked"' : '')); ?> /><label for="published2">Yes</label>
				</div>
			</div>
		</div>
	</div>
</form>

<?php require(ADMIN_TEMPLATE_FOOTER);