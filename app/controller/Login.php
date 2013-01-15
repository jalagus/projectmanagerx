<?php

class Login {

	public function __construct() {

	}

	public function doLogin($username, $password) {
		if ($this->checkCredentials($username, $password)) {
			session_start();

			$_SESSION['user'] = $username;
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

	public function isLogged() {
		
	}
}

$login = new Login();

if ($_GET['action'] == "logout") {
	$login->logout();
}
else {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$login->doLogin($username, $password);
}
header("Location: ../index.php");
?>
