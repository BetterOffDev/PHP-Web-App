<?php
//User.class.php

require_once 'DB.class.php';

class User {

	public $id;
	public $username;
	public $hashedPassword;
	public $email;
	public $joinDate;

	function __construct($data) {
		$this->id = ( isset($data['id']) ) ? $data['id'] : "";
		$this->username = ( isset($data['username']) ) ? $data['username'] : "";
		$this->hashedPassword = ( isset($data['password']) ) ? $data['password'] : "";
		$this->email = ( isset($data['email']) ) ? $data['email'] : "";
		$this->joinDate = ( isset($data['joinDate']) ) ? $data['joinDate'] : "";
	}

	public function save($isNewUser = false) {

		// update user info if user is already registered
		if (!$isNewUser) {
			$data = array(
				"username" => $this->username,
				"password" => $this->hashedPassword,
				"email" => $this->email,
				"id" => $this->id
			);

			$database = new DB();
			$database->query('UPDATE users SET username = :username, password = :password, email = :email WHERE id = :id');

			$database->bind(':id', $this->id);
			$database->bind(':username', $this->username);
			$database->bind(':email', $this->email);
			$database->bind(':password', $this->hashedPassword);

			$database->execute();
		}

		// add new user
		else {
			$data = array(
				"username" => $this->username,
				"password" => $this->hashedPassword,
				"email" => $this->email,
				"join_date" => date("Y-m-d H:i:s", time())
			);
			$this->joinDate = time();

			$database = new DB();
			$database->query('INSERT INTO users (username, password, email, join_date) VALUES (:username, :password, :email, :join_date)');

			$database->bind(':username', $this->username);
			$database->bind(':email', $this->email);
			$database->bind(':password', $this->hashedPassword);
			$database->bind(':join_date', $this->joinDate );

			$database->execute();
		}
		return true;
	}

}// end User class



?>