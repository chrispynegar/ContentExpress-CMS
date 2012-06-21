<?php

/**
 * Article manager
 *
 * The management screen for managing articles.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(4);

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$per_page = 10;

$total_count = Article::count_all();

$pagination = new Pagination($page, $per_page, $total_count);

$articles = Article::select_paginated($per_page);

$title = 'Article Manager';

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<form class="search-form" action="#" method="post">
		<label for="search">Search</label>
		<input type="text" name="search" id="search" value="" />
		<a href="#" class="submit">Go</a>
	</form>
	<a href="./article-editor.php" class="toolbar-button" title="Add"><img src="../library/icons/add.png" alt="Add icon" /> Add</a>
	<a href="#" class="toolbar-button" title="Settings"><img src="../library/icons/process.png" alt="Settings icon" /> Settings</a>
	<a href="#" class="toolbar-button" title="Help"><img src="../library/icons/help.png" alt="Help icon" /> Help</a>
</div>
<div class="main-column">
	<?php if($total_count > 0): ?>
	<table>
		<tr class="table-header">
			<th>ID</th>
			<th>Author</th>
			<th>Name</th>
			<th>Active</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach($articles as $article): ?>
		<tr>
			<td><?php echo $article->id; ?></td>
			<?php $author = User::find_by_id($article->author); ?>
			<td><?php echo ($author->fullname() ? $author->fullname() : $author->username); ?></td>
			<td><?php echo $article->name; ?></td>
			<td><span class="<?php echo ($article->published == 1 ? 'published">Yes' : 'not-published">No'); ?></span></td>
			<td><a href="./article-editor.php?id=<?php echo htmlentities($article->id); ?>" title="Edit <?php echo $article->title; ?>">Edit</a></td>
			<td><a href="./article-delete.php?id=<?php echo htmlentities($article->id); ?>" title="Delete <?php echo $article->title; ?>" class="delete-alert">Delete</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p class="no-results">There are no articles to display.</p>
	<?php endif; ?>
	<?php $pagination->display('article-manager.php', $page); ?>
</div>

<div class="modal-content delete-alert-dialog" title="Warning">
    <p>Are you sure you want to delete this article?</p>
</div>

<?php require(ADMIN_TEMPLATE_FOOTER); ?>