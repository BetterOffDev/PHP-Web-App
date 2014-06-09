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

		$db = new DB();

		// update user info if user is already registered
		if (!$isNewUser) {
			$data = array(
				"username" => "'$this->username'",
				"password" => "'$this->hashedPassword'",
				"email" => "'$this->email'"
			);

			$db->update($data, 'users', 'id = '.$this->id);
		}

		// add new user
		else {
			$data = array(
				"username" => "'$this->username'",
				"password" => "'$this->hashedPassword'",
				"email" => "'$this->email'",
				"join_date" => "'".date("Y-m-d H:i:s", time())."'"
			);

			$this->id = $db->insert($data, 'users');
			$this->joinDate = time();
		}
		return true;
	}

}// end User class



?>