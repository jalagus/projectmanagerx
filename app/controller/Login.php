<?php

class Login {

	public function __construct() {

	}

	public function doLogin($username, $password) {
		if (checkCredentials($username, $password)) {
			session_start();

			$_SESSION[] = $username;
		}
		else {
			return false;
		}
	}

	public function checkCredentials($username, $password) {
		return true;
	}

	public function logout() {
		session_start();
		session_destroy();
	}
}

?>
