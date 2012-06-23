<?php 

$options = explode(', ', $item->options);

$option = array();
foreach($options as $key => $value) {
	$option_value = explode(': ', $value);
	$option[strtolower($option_value[0])] = $option_value[1];
}

if($option['type'] == 'articles') {
	$articles = Article::find_all();
} elseif($option['type'] == 'products') {
	
}
?>

<div class="featured-<?php echo $option['type']; ?>">
	<?php if($option['type'] == 'articles'): ?>
	<?php foreach($articles as $a): ?>
	<div class="article">
		<div class="name"><?php echo $a->name; ?></div>
		<div class="content"><?php echo $a->content; ?></div>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>
</div>