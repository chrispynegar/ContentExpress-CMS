<?php

/**
 * User editor
 *
 * Visual for creating and editing users.
 *
 * @package Content Express CMS
 * @author Chris Pynegar
 */

require('../library/load.php');

if(!$session->is_logged_in()) $system->redirect('login.php');

Permission::access(4);

if(isset($_GET['id'])) {
	$user = User::find_by_id($_GET['id']);
}

if(isset($_POST['submit_form']) && $_POST['submit_form'] == 'accept') {
	if(isset($user->id)) {
		$user->save_user(null, $user->id, 'user-manager.php');
	} else {
		$user = new User();
		$user->save_user(null, null, 'user-manager.php');
	}
} elseif(isset($_POST['submit_form']) && $_POST['submit_form'] == 'save') {
	if(isset($user->id)) {
		$user->save_user(null, $user->id, 'user-manager.php');
	} else {
		$user = new User();
		$user->save_user();
	}
}

$title = (isset($user->id) ? 'Edit' : 'Create').' User';

$scripts = array('editor');

require(ADMIN_TEMPLATE_HEADER);

?>

<div class="toolbar">
	<a href="#" class="toolbar-button accept" title="Accept"><img src="../library/icons/accept_page.png" alt="Accept page icon" /> Accept</a>
	<a href="#" class="toolbar-button save" title="Save"><img src="../library/icons/accept.png" alt="Accept icon" /> Save</a>
	<a href="#" class="toolbar-button" title="Help"><img src="../library/icons/help.png" alt="Help icon" /> Help</a>
</div>
<form action="user-editor.php<?php echo (isset($user->id) ? '?id='.htmlentities($user->id) : ''); ?>" method="post" class="editor-form" id="editor">
	<div class="left-column">
		<?php $system->message(); ?>
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo (isset($_POST['username']) ? $_POST['username'] : (isset($user->username) ? $user->username : '')); ?>" />
		<span class="hint username-hint"></span>
		<?php if(!isset($user->password)): ?>
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="<?php echo (isset($_POST['password']) ? $_POST['password'] : ''); ?>" />
		<p class="hint password-hint"></p>
		<label for="password2">Re-Enter Password</label>
		<input type="password" name="password2" id="password2" value="<?php echo (isset($_POST['password2']) ? $_POST['password2'] : ''); ?>" />
		<span class="hint password2-hint"></span>
		<?php endif; ?>
		<label for="email">Email Address</label>
		<input type="text" name="email" id="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : (isset($user->email) ? $user->email : '')); ?>" />
		<span class="hint email-hint"></span>
		<label for="first_name">First Name</label>
		<input type="text" name="first_name" id="first_name" value="<?php echo (isset($_POST['first_name']) ? $_POST['first_name'] : (isset($user->first_name) ? $user->first_name : '')); ?>" />
		<span class="hint first-name-hint"></span>
		<label for="last_name">Last Name</label>
		<input type="text" name="last_name" id="last_name" value="<?php echo (isset($_POST['last_name']) ? $_POST['last_name'] : (isset($user->last_name) ? $user->last_name : '')); ?>" />
		<span class="hint last-name-hint"></span>
		<label for="permission">Access level</label>
		<select name="permission" id="permission">
			<?php $permissions = Permission::find_all(); ?>
			<?php foreach($permissions as $permission): ?>
			<option value="<?php echo $permission->id; ?>"<?php echo (isset($_POST['permission']) && $_POST['permission'] == $permission->id ? ' selected="selected"' : (isset($user->permission) && $user->permission == $permission->id ? ' selected="selected"' : '')); ?>><?php echo $permission->name; ?></option>
			<?php endforeach; ?>
		</select>
		<span class="hint permission-hint"></span>
		<label for="url">URL</label>
		<input type="text" name="url" id="url" value="<?php echo (isset($_POST['url']) ? $_POST['url'] : (isset($user->url) ? $user->url : '')); ?>" />
		<span class="hint url-hint"></span>
		<label for="bio">Bio</label>
		<textarea name="bio" id="bio" class="editor"><?php echo (isset($_POST['bio']) ? $_POST['bio'] : (isset($user->bio) ? $user->bio : '')); ?></textarea>
		<span class="hint bio-hint"></span>
		<?php if(isset($user->password)): ?>
		<p>Leave this blank if you do not want to change the password for this user.</p>
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" />
		<span class="hint password-hint"></span>
		<label for="password2">Re-Enter Password</label>
		<input type="password" name="password2" id="password2" value="" />
		<span class="hint password2-hint"></span>
		<?php endif; ?>
	</div>
	<div class="right-column">
		<div class="accordion">
			<h3><a href="#">Information</a></h3>
			<div>
				<p>Current Status:</p>
				<p><?php echo (isset($user->active) && $user->active == 1 ? 'Active' : 'Not active' ); ?></p>
				<?php if(isset($user->date_modified) && $user->date_modified !== $user->date_created): ?>
				<p>Date Modified:</p>
				<p><?php echo $user->date_modified; ?></p>
				<?php endif; ?>
				<p>Date Created:</p>
				<p><?php echo (isset($user->date_created) ? $user->date_created : 'Not yet created'); ?></p>
			</div>
			<h3><a href="#">Settings</a></h3>
			<div>
				<label for="active">User Active</label>
				<div class="buttonset">
					<input type="radio" name="active" id="active1" value="0"<?php echo (isset($user->active) && $user->active == 0 ? ' checked="checked"' : ''); ?> /><label for="active1">No</label>
					<input type="radio" name="active" id="active2" value="1"<?php echo (isset($user->active) && $user->active == 1 ? ' checked="checked"' : (!isset($user->active) ? ' checked="checked"' : '')); ?> /><label for="active2">Yes</label>
				</div>
			</div>
		</div>
	</div>
</form>

<?php require(ADMIN_TEMPLATE_FOOTER);