<?php
// settings.php

require_once 'includes/global.inc.php';

// check to see if user is logged in
if ( !isset($_SESSION['logged_in'])) {
	header("Location: login.php");
}

// get the User object from the session
$user = unserialize($_SESSION['user']);

// init variables for form
$email = $user->email;
$message = "";

// check if form has been submitted
if ( isset($_POST['submit-settings'])) {
	$email = $_POST['email'];
	$user->email = $email;
	$user->save();

	$message = "Settings saved!";
}

// display the form if it hasn't been submitted or didn't validate
$title = "Change Settings";
include('header.php');

if ($message != "") { 
		?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<p class="bg-success"><?php echo $message; ?></p>
				</div>
			</div>
		</div><?php
	}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<form action="settings.php" method="post" role="form">
				<div class="form-group">
					<label for="email">E-mail</label>
					<input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
				</div>
				<button type="submit" class="btn btn-default" name="submit-settings">Update</button>
			</form>
		</div>
	</div>
</div>

<?php include('footer.php');