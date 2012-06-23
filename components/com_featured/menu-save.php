<?php

/**
  * Featured Component Menu Form
  *
  * Featured save for the page component
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

if(!$validation->required($_POST['com_type'])) {
	$session->message('You must select a feature type.');
	return false;
}

$this->options = 'Type: '.$_POST['com_type'];

?>