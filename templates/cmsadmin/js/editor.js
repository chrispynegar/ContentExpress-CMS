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

	// Form helper hints
	
	$('#username').focusin(function() {
		$('.username-hint').html('Enter a username between 3 and 30 characters long');
		$('.username-hint').fadeIn(500);
	});
	
	$('#username').focusout(function() {
		$('.username-hint').fadeOut(500);
	});

	$('#password').focusin(function() {
		$('.password-hint').html('Enter a password between 6 and 12 characters long');
		$('.password-hint').fadeIn(500);
	});
	
	$('#password').focusout(function() {
		$('.password-hint').fadeOut(500);
	});
	
	$('#password2').focusin(function() {
		$('.password2-hint').html('Please re-enter your password');
		$('.password2-hint').fadeIn(500);
	});
	
	$('#password2').focusout(function() {
		$('.password2-hint').fadeOut(500);
	});
	
	$('#email').focusin(function() {
		$('.email-hint').html('Please enter a valid email address');
		$('.email-hint').fadeIn(500);
	});
	
	$('#email').focusout(function() {
		$('.email-hint').fadeOut(500);
	});
	
	$('#first_name').focusin(function() {
		$('.first-name-hint').html('Please enter a first name');
		$('.first-name-hint').fadeIn(500);
	});
	
	$('#first_name').focusout(function() {
		$('.first-name-hint').fadeOut(500);
	});
	
	$('#last_name').focusin(function() {
		$('.last-name-hint').html('Please enter a last name');
		$('.last-name-hint').fadeIn(500);
	});
	
	$('#last_name').focusout(function() {
		$('.last-name-hint').fadeOut(500);
	});
	
	$('#permission').focusin(function() {
		$('.permission-hint').html('Please select the access level');
		$('.permission-hint').fadeIn(500);
	});
	
	$('#permission').focusout(function() {
		$('.permission-hint').fadeOut(500);
	});
	
	$('#url').focusin(function() {
		$('.url-hint').html('Please enter a valid url');
		$('.url-hint').fadeIn(500);
	});
	
	$('#url').focusout(function() {
		$('.url-hint').fadeOut(500);
	});
	
	$('#bio').focusin(function() {
		$('.bio-hint').html('Please enter a short bio');
		$('.bio-hint').fadeIn(500);
	});
	
	$('#bio').focusout(function() {
		$('.bio-hint').fadeOut(500);
	});

});