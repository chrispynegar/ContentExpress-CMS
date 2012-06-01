<?php

require('../library/load.php');

if($session->is_logged_in()) {
	if(Permission::access(4)) {
		$session->message('You are already logged in.');
		$system->redirect('index.php');
	} else {
		$system->redirect('../index.php');
	}
}

if(isset($_POST['submit'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$user = User::authenticate($username, $password);
	if($user) {
		$session->login($user);
		$session->message('You are now logged in.');
		$system->redirect('index.php');
	} else {
		$session->message('Login credentials were incorrect.');
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Log In</title>
	<link rel="stylesheet" href="../templates/cmsadmin/css/style.css" />
</head>
<body>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="login-container">
		<h1>Login</h1>
		<?php $system->message(); ?>
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="" />
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" />
		<input type="submit" name="submit" value="Log In" />
	</form>

</body>
</html>