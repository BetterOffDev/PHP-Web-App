<?php
//UserTools.class.php

require_once 'User.class.php';
require_once 'DB.class.php';

class UserTools {

	// user login
	public function login($username, $password) {

		$hashedPassword = md5($password);
		$result = mysql_query("SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword'");

		if (mysql_num_rows($result) == 1) {
			$_SESSION['user'] = serialize(new User(mysql_fetch_assoc($result)));
			$_SESSION['login_time'] = time();
			$_SESSION['logged_in'] = 1;
			return true;
		}

		else {
			return false;
		}
	}

	// user logout
	public function logout() {
		unset($_SESSION['user']);
		unset($_SESSION['login_time']);
		unset($_SESSION['logged_in']);
		session_destroy();
	}

	// check if username already exists
	public function checkUsernameExists($username) {
		$result = mysql_query("SELECT id FROM users WHERE username='$username'");
		if (mysql_num_rows($result) == 0) {
			return false;
		}
		else {
			return true;
		}
	}

	// get user
	public function get($id) {
		$db = new DB();
		$result = $db->select('users', "id = $id");

		return new User($result);
	}

	

}// end UserTools class


?>