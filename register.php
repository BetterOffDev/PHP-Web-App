<?php
// register.php

require_once 'includes/global.inc.php';

// initialize variables
$username = "";
$password = "";
$password_confirm = "";
$email = "";
$error = "";

// check to see if the form has already been submitted
if ( isset($_POST['submit-form']) ) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password-confirm'];
	$email = $_POST['email'];


	// form validation variable init
	$success = true;
	$userTools = new UserTools();

	// form validation
	
	// check if username already exists
	if ($userTools->checkUsernameExists($username)) {
		$error .= "Sorry. That username is already taken. Please try again.<br /> \n\r";
		$success = false;
	}

	// confirm matching passwords
	if ($password != $password_confirm) {
		$error .= "Passwords do not match.<br /> \n\r";
		$success = false;
	}

	if ($success) {
		$data['username'] = $username;
		$data['password'] = md5($password);
		$data['email'] = $email;

		// create new User object
		$newUser = new User($data);

		// save the new User
		$newUser->save(true);

		// log in the user
		$userTools->login($username, $password);

		// redirect to welcome page
		header("Location: welcome.php");
	}
}

// show registration form again if form fails validation

?>
<?php 
	$title = "Register";
	include('header.php'); 
?>
<?php if ($error != "") { 
		?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<p class="bg-danger"><?php echo $error; ?></p>
				</div>
			</div>
		</div><?php
	}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<form action="register.php" method="post" role="form">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
				</div>
				<div class="form-group">
					<label for="password-confirm">Confirm Pasword</label>
					<input type="password" class="form-control" name="password-confirm" value="<?php echo $password_confirm; ?>">
				</div>
				<div class="form-group">
					<label for="email">E-mail</label>
					<input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
				</div>
				<button type="submit" class="btn btn-default" name="submit-form">Register</button>
			</form>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>