<?php
// global.inc.php

require_once 'classes/User.class.php';
require_once 'classes/UserTools.class.php';
require_once 'classes/DB.class.php';

// connect to the database
$db = new DB();

// initialize UserTools object
$userTools = new UserTools();

// start the session
session_start();

// refresh session variables if already logged in
if ( isset($_SESSION['loggin_in'])) {
	$user = unserialize($_SESSION['user']);
	$SESSION['user'] = serialize($userTools->get($id));
}

?>