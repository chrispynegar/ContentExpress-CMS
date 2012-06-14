<?php

/**
  * Page Component Menu Form
  *
  * Menu save for the page component
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

if(!$validation->required($_POST['com_page'])) {
	$session->message('You must select a page.');
	return false;
}

$this->options = 'Page: '.$_POST['com_page'];

?>