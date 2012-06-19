<?php 

$options = explode(', ', $item->options);

$option = array();
foreach($options as $key => $value) {
	$option_value = explode(': ', $value);
	$option[strtolower($option_value[0])] = $option_value[1];
}

$com_page = Page::find_by_id($option['page']);

?>

<div class="page-alias-here">
	<h2 class="title"><?php echo $com_page->title; ?></h2>
	<div class="content">
		<?php echo nl2br($com_page->content, ALLOWED_TAGS); ?>
	</div>
</div>