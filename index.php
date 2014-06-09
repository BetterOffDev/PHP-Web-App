<?php
// index.php

require_once 'includes/global.inc.php';
$title = "Home";
include('header.php');

if ( isset($_SESSION['logged_in'])) : 
	$user = unserialize($_SESSION['user']); 
	?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="jumbotron">
					<h1>Hello, <?php echo $user->username; ?>!</h1>
					<p>You are logged in.</p>
					<p><a class="btn btn-primary btn-lg" role="button" href="settings.php">Settings</a></p>
					<p><a class="btn btn-primary btn-lg" role="button" href="logout.php">Logout</a></p>
				</div>
			</div>
		</div>
	</div>
<?php else : ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="jumbotron">
					<h1>Welcome!</h1>
					<p>Please login or register as a new user.</p>
					<p><a class="btn btn-primary btn-lg" role="button" href="login.php">Login</a></p>
					<p><a class="btn btn-primary btn-lg" role="button" href="register.php">Register</a></p>
				</div>
			</div>
		</div>
	</div>
<?php endif; 
	include('footer.php');
?>