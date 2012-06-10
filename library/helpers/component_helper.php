<?php

if(!defined('SITE_ROOT')) exit('Direct access denied');

/**
 * Components helper
 *
 * Handles various component related tasks
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

class Component {
	
	public function build_form_fields($data) {
		if(is_array($data)) {
			foreach($data as $d) {
				echo '<label for="'.$d['name'].'">'.$d['label'].'</label>';
				if($d['input'] == 'text') {
					echo '<input type="'.$d['input'].'" name="'.$d['name'].'" id="'.$d['name'].'" value="" />';
				} elseif($d['input'] == 'select') {
					echo '<select name="'.$d['name'].'" id="'.$d['name'].'">';
					$i = 0;
					foreach($d['options'] as $option) {
						echo '<option value="'.$option['value'].'">'.$option['label'].'</option>';
						$i++;
					}
					echo '</select>';
				}
			}
		}
	}
	
}

$component = new Component();

?>