<?php

/**
  * Page Component Menu Form
  *
  * Menu form for the page component
  *
  * @package Content Express CMS
  * @author Chris Pynegar
 */

$com_pages = Page::find_all();

?>
<label for="page">Page</label>
<select name="com_page" id="page">
	<?php foreach($com_pages as $p): ?>
	<option value="<?php echo $p->id; ?>"><?php echo $p->title; ?></option>
	<?php endforeach; ?>
</select>