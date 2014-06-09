<?php
// welcome.php

require_once 'includes/global.inc.php';

// check to see if user is already logged in
if ( !isset($_SESSION['logged_in'])) {
	header("Location: login.php");
}

// get the User object from the session
$user = unserialize($_SESSION['user']);

?>
<?php 
	$title = "Welcome!";
	include('header.php'); 
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="jumbotron">
				<h1>Hello, <?php echo $user->username; ?>!</h1>
				<p>You've been registered and logged in.</p>
				<p><a class="btn btn-primary btn-lg" role="button" href="index.php">Home Page</a></p>
				<p><a class="btn btn-primary btn-lg" role="button" href="logout.php">Logout</a></p>
			</div>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>