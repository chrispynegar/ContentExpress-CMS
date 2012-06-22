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
	$article = Article::find_by_id($_GET['id']);
}

if(isset($_POST['submit_form']) && $_POST['submit_form'] == 'accept') {
	if(isset($article->id)) {
		$article->save_article(null, $article->id, 'article-manager.php');
	} else {
		$article = new article();
		$article->save_article(null, null, 'article-manager.php');
	}
} elseif(isset($_POST['submit_form']) && $_POST['submit_form'] == 'save') {
	if(isset($article->id)) {
		$article->save_article(null, $article->id);
	} else {
		$article = new article();
		$article->save_article();
	}
}

$title = (isset($article->id) ? 'Edit' : 'Create').' Article';

$scripts = array('editor');

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<a href="#" class="toolbar-button accept" title="Accept"><img src="../library/icons/accept_page.png" alt="Accept article icon" /> Accept</a>
	<a href="#" class="toolbar-button save" title="Save"><img src="../library/icons/accept.png" alt="Accept icon" /> Save</a>
	<a href="#" class="toolbar-button" title="Help"><img src="../library/icons/help.png" alt="Help icon" /> Help</a>
</div>
<form action="article-editor.php<?php echo (isset($article->id) ? '?id='.htmlentities($article->id) : ''); ?>" method="post" class="editor-form" id="editor">
	<div class="left-column">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" value="<?php echo (isset($_POST['name']) ? $_POST['name'] : (isset($article->name) ? $article->name : '')); ?>" />
		<label for="category">Category</label>
		<select name="category" id="category">
			<?php $categories = Category::find_all(); ?>
			<?php foreach($categories as $category): ?>
			<?php $selected = (isset($_POST['category']) && $_POST['category'] == $category->id ? ' selected="selected"' : (isset($article->category) && $article->category == $category->id ? ' selected="selected"' : '')); ?>
			<option value="<?php echo $category->id; ?>"<?php echo $selected; ?>><?php echo $category->name; ?></option>
			<?php endforeach; ?>
		</select>
		<label for="tags">Tags</label>
		<input type="text" name="tags" id="tags" value="<?php echo (isset($_POST['tags']) ? $_POST['tags'] : (isset($article->tags) ? $article->tags : '')); ?>" />
		<label for="content">Content</label>
		<textarea name="content" id="content" class="editor"><?php echo (isset($_POST['content']) ? $_POST['content'] : (isset($article->content) ? $article->content : '')); ?></textarea>
	</div>
	<div class="right-column">
		<div class="accordion">
			<h3><a href="#">Information</a></h3>
			<div>
				<p>Current Status:</p>
				<p><?php echo (isset($article->published) && $article->published == 1 ? 'Published' : 'Not published' ); ?></p>
				<?php if(isset($article->date_modified) && $article->date_modified !== $article->date_created): ?>
				<p>Date Modified:</p>
				<p><?php echo $article->date_modified; ?></p>
				<?php endif; ?>
				<p>Date Created:</p>
				<p><?php echo (isset($article->date_created) ? $article->date_created : 'Not yet created'); ?></p>
			</div>
			<h3><a href="#">Settings</a></h3>
			<div>
				<label for="active">Article Published</label>
				<div class="buttonset">
					<input type="radio" name="published" id="published1" value="0"<?php echo (isset($article->published) && $article->published == 0 ? ' checked="checked"' : ''); ?> /><label for="published1">No</label>
					<input type="radio" name="published" id="published2" value="1"<?php echo (isset($article->published) && $article->published == 1 ? ' checked="checked"' : (!isset($article->published) ? ' checked="checked"' : '')); ?> /><label for="published2">Yes</label>
				</div>
				<label for="comments">Enable Comments</label>
				<div class="buttonset">
					<input type="radio" name="comments" id="comments1" value="0"<?php echo (isset($article->comments) && $article->comments == 0 ? ' checked="checked"' : ''); ?> /><label for="comments1">No</label>
					<input type="radio" name="comments" id="comments2" value="1"<?php echo (isset($article->comments) && $article->comments == 1 ? ' checked="checked"' : (!isset($article->comments) ? ' checked="checked"' : '')); ?> /><label for="comments2">Yes</label>
				</div>
				<label for="sharing">Social Sharing</label>
				<div class="buttonset">
					<input type="radio" name="sharing" id="sharing1" value="0"<?php echo (isset($article->sharing) && $article->sharing == 0 ? ' checked="checked"' : ''); ?> /><label for="sharing1">No</label>
					<input type="radio" name="sharing" id="sharing2" value="1"<?php echo (isset($article->sharing) && $article->sharing == 1 ? ' checked="checked"' : (!isset($article->sharing) ? ' checked="checked"' : '')); ?> /><label for="sharing2">Yes</label>
				</div>
			</div>
			<h3><a href="#">Meta Data</a></h3>
			<div>
				<label for="keywords">Keywords</label>
				<input type="text" name="keywords" id="keywords" value="<?php echo (isset($_POST['keywords']) ? $_POST['keywords'] : (isset($article->keywords) ? $article->keywords : '')); ?>" />
				<label for="description">Description</label>
				<input type="text" name="description" id="description" value="<?php echo (isset($_POST['description']) ? $_POST['description'] : (isset($article->description) ? $article->description : '')); ?>" />
			</div>
		</div>
	</div>
</form>

<?php require(ADMIN_TEMPLATE_FOOTER);