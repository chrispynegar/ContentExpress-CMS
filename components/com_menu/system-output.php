<ul class="main-menu">
	<?php foreach($items as $item): ?>
	<li><a href="<?php echo BASE_URL; ?>index.php?item=<?php echo $item->alias; ?>"><?php echo $item->title; ?></a></li>
	<?php endforeach; ?>
</ul>