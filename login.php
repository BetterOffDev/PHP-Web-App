<?php
// login.php

require_once 'includes/global.inc.php';

$error = "";
$username = "";
$password = "";

// check to see if login form has been submitted
if ( isset($_POST['submit-login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$userTools = new UserTools();
	if ($userTools->login($username, $password)) {
		header("Location: index.php");
	}
	else {
		$error = "Incorrect username or password. Please try again.";
	}
}
?>

<?php 
	$title = "Login";
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
			<form action="login.php" method="post" role="form">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
				</div>
				<button type="submit" class="btn btn-default" name="submit-login">Login</button>
			</form>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>