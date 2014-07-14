<?php
//UserTools.class.php

require_once 'User.class.php';
require_once 'DB.class.php';

class UserTools {

	// user login
	public function login($username, $password) {

		$hashedPassword = md5($password);
		$database = new DB();
		$database->query('SELECT * FROM users WHERE username = :username AND password = :password');

		$database->bind(':username', $username);
		$database->bind(':password', $hashedPassword);

		$user = $database->single();

		if ( $database->rowCount() == 1) {
			$_SESSION['user'] = serialize( new User($user) );
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
		$database = new DB();
		$database->query('SELECT * FROM users WHERE username = :username');

		$database->bind(':username', $username);

		$database->execute();

		if ($database->rowCount() == 0) {
			return false;
		}
		else {
			return true;
		}
	}

	// get user
	public function get($id) {
		$database = new DB();
		$database->query('SELECT * FROM users WHERE id = :id');

		$database->bind(':id', $id);

		$user = $database->single();

		return new User($user);
	}

	

}// end UserTools class


?>