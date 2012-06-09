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

if(isset($_GET['id'])) {
	$page = Page::find_by_id($_GET['id']);
}

if(isset($_POST['submit_form']) && $_POST['submit_form'] == 'accept') {
	if(isset($page->id)) {
		$page->save_page(null, $page->id, 'page-manager.php');
	} else {
		$page = new Page();
		$page->save_page(null, null, 'page-manager.php');
	}
} elseif(isset($_POST['submit_form']) && $_POST['submit_form'] == 'save') {
	if(isset($page->id)) {
		$page->save_page(null, $user->id, 'page-manager.php');
	} else {
		$page = new Page();
		$page->save_page();
	}
}

$title = (isset($page->id) ? 'Edit' : 'Create').' Page';

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
		<input type="text" name="title" id="title" value="<?php echo (isset($_POST['title']) ? $_POST['title'] : (isset($page->title) ? $page->title : '')); ?>" />
		<span class="hint title-hint"></span>
		<label for="content">Content</label>
		<textarea name="content" id="content" class="editor"><?php echo (isset($_POST['content']) ? $_POST['content'] : (isset($page->content) ? $page->content : '')); ?></textarea>
		<span class="hint bio-hint"></span>
	</div>
	<div class="right-column">
		<div class="accordion">
			<h3><a href="#">Information</a></h3>
			<div>
				<p>Current Status:</p>
				<p><?php echo (isset($page->published) && $page->published == 1 ? 'Published' : 'Not published' ); ?></p>
				<?php if(isset($page->date_modified) && $page->date_modified !== $page->date_created): ?>
				<p>Date Modified:</p>
				<p><?php echo $page->date_modified; ?></p>
				<?php endif; ?>
				<p>Date Created:</p>
				<p><?php echo (isset($page->date_created) ? $page->date_created : 'Not yet created'); ?></p>
			</div>
			<h3><a href="#">Settings</a></h3>
			<div>
				<label for="published">Page Published</label>
				<div class="buttonset">
					<input type="radio" name="published" id="published1" value="0"<?php echo (isset($page->published) && $page->published == 0 ? ' checked="checked"' : ''); ?> /><label for="published1">No</label>
					<input type="radio" name="published" id="published2" value="1"<?php echo (isset($page->published) && $page->published == 1 ? ' checked="checked"' : (!isset($page->published) ? ' checked="checked"' : '')); ?> /><label for="published2">Yes</label>
				</div>
			</div>
			<h3><a href="#">Meta Data</a></h3>
			<div>
				<label for="keywords">Keywords</label>
				<input type="text" name="keywords" id="keywords" value="<?php echo (isset($_POST['keywords']) ? $_POST['keywords'] : (isset($page->keywords) ? $page->keywords : '')); ?>" />
				<label for="description">Description</label>
				<input type="text" name="description" id="description" value="<?php echo (isset($_POST['description']) ? $_POST['description'] : (isset($page->description) ? $page->description : '')); ?>" />
			</div>
		</div>
	</div>
</form>

<?php require(ADMIN_TEMPLATE_FOOTER);