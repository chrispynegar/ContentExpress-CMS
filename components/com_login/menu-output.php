<?php 

/*
$options = explode(', ', $item->options);

$option = array();
foreach($options as $key => $value) {
	$option_value = explode(': ', $value);
	$option[strtolower($option_value[0])] = $option_value[1];
}
*/

if(isset($_POST['com_login_submit'])) {
	$com_username = trim($_POST['com_username']);
	$com_password = trim($_POST['com_password']);
	$com_user = User::authenticate($com_username, $com_password);
	if($com_user) {
		$session->login($com_user);
		$session->message('You are now logged in.');
		//$system->redirect($system->currenturl());
	} else {
		$session->message('Login credentials were incorrect.');
	}
}

?>

<div class="login-container">
	<?php if($session->is_logged_in()): ?>
	<p>You are already logged in.</p>
	<?php else: ?>
	<form action="<?php echo $system->currenturl(); ?>" method="post">
		<label for="com_username">Username</label>
		<input type="text" name="com_username" id="com_username" />
		<label for="com_password">Password</label>
		<input type="password" name="com_password" id="com_password" />
		<input type="submit" name="com_login_submit" value="Login" />
	</form>
	<?php endif; ?>
</div>