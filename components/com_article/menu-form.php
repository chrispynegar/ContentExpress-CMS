<?php

/**
  * Article Component Menu Form
  *
  * Menu form for the article component
  *
  * @package Content Express CMS
  * @author Chris Pynegar
 */

$com_articles = Article::find_all();

?>
<label for="com_article">Article</label>
<select name="com_article" id="article">
	<?php foreach($com_articles as $a): ?>
	<option value="<?php echo $a->id; ?>"><?php echo $a->name; ?></option>
	<?php endforeach; ?>
</select>