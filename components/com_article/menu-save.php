<?php

/**
  * Article Component Menu Form
  *
  * Menu save for the article component
  *
  * @package Content Express CMS
  * @author Chris Pynegar
 */

/****

Formatting options

Each option must be surrounded by single quotes '' with a colon after the option name : each option must be seperated with a comma ,

Example:

'Option 1: Value 1', 'Option 2: Value 2'

*****/

if(!$validation->required($_POST['com_article'])) {
	$session->message('You must select a article.');
	return false;
}

$this->options = 'Article: '.$_POST['com_article'];

?>