<?php 

$options = explode(', ', $item->options);

$option = array();
foreach($options as $key => $value) {
	$option_value = explode(': ', $value);
	$option[strtolower($option_value[0])] = $option_value[1];
}

$com_article = Article::find_by_id($option['article']);

if(isset($_POST['com_comment_submit'])) {
	$data = array();
	if(!$session->is_logged_in()) {
		$data['name'] = $_POST['com_name'];
		$data['email'] = $_POST['com_email'];
		$data['url'] = $_POST['com_url'];
	} else {
		$data['user_id'] = $_SESSION['user_id'];
	}
	$data['comment'] = $_POST['com_comment'];
	$data['article_id'] = $com_article->id;
	$comment = new Comment();
	$comment->save_comment($data, 'article', null, $system->currenturl());
}

?>

<div class="article-alias-here">
	<h2 class="name"><?php echo $com_article->name; ?></h2>
	<div class="content">
		<?php echo nl2br($com_article->content, ALLOWED_TAGS); ?>
	</div>
	<?php if(isset($com_article->comments) && $com_article->comments == 1): ?>
	<div class="comments">
		<h3>Comments</h3>
		<?php $comments = Comment::get_comments('article', $com_article->id); ?>
		<?php foreach($comments as $comment): ?>
		<div class="comment">
			<?php
			if(isset($comment->user_id) && !empty($comment->user_id)) {
				$user = User::find_by_id($comment->user_id);
				$name = $user->fullname();
			} else {
				$name = $comment->name;
			}
			?>
			<div class="comment-name"><?php echo $name; ?></div>
			<div class="comment-content">
				<?php echo $comment->comment; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="article-comments-form">
		<form action="" method="post">
			<?php if(!$session->is_logged_in()): ?>
			<label for="com_name">Name</label>
			<input type="text" name="com_name" id="com_name" />
			<label for="com_email">Email</label>
			<input type="text" name="com_email" id="com_email" />
			<label for="com_url">URL</label>
			<input type="text" name="com_url" id="com_url" />
			<?php endif; ?>
			<label for="com_comment">Comment</label>
			<textarea name="com_comment" id="com_comment"></textarea>
			<input type="submit" name="com_comment_submit" />
		</form>
	</div>
	<?php endif; ?>
</div>