<?php

$com = array();

$page_options = array();

$i = 0;
$pages = Page::find_all();
foreach($pages as $page) {
	$page_options[$i]['label'] = $page->title;
	$page_options[$i]['value'] = $page->id;
	$i++;
}

$com['menu'] = array(
	
	$com['test'] = array(
		'label' => 'Test Input',
		'name' => 'test',
		'input' => 'text'
	),
	$com['page'] = array(
		'label' => 'Select Page',
		'name' => 'page',
		'input' => 'select',
		'options' => $page_options
	)
	
);

?>