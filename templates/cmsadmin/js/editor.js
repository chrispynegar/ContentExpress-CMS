$(document).ready(function() {

	// form submit
	
	$('.toolbar .accept').live('click', function(e) {
		e.preventDefault();
		var submit_type = $('<input type="hidden" name="submit_form" value="accept" />');
		$('form.editor-form').append(submit_type);
		$('form.editor-form').submit();
	});
	
	$('.toolbar .save').live('click', function(e) {
		e.preventDefault();
		var submit_type = $('<input type="hidden" name="submit_form" value="save" />');
		$('form.editor-form').append(submit_type);
		$('form.editor-form').submit();
	});

});