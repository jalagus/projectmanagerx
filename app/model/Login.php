<?php

class Login {
	
	public $database;
	
	public function __construct($db) {
		$this->database = $db;
	}

	public function doLogin($username, $password) {
		if ($this->checkCredentials($username, $password)) {
			if(session_id() == '') {
    			session_start();
			}
			
			$_SESSION['user'] = $username;
			
			return true;
		}
		else {
			return false;
		}
	}

	public function checkCredentials($username, $password) {
		$result = $this->database->doQuery("SELECT id FROM users WHERE username = '$username' AND password='$password'");
		
		if ($result->num_rows > 0) {
			return true;
		}
		else {
			return false;
		}
	}

	public function logout() {
		if(session_id() == '') {
    		session_start();
		}	
		
		session_destroy();
		unset($_SESSION['user']);
	}

	public function isLogged() {
		if (isset($_SESSION['user'])) {
			return true;
		}
		
		return false;
	}
}

?>
