<?php

include_once("controller/Controller.php");

class LoginController extends Controller {	

	public function invoke() {
		$action = $_POST['action'];
		
		if ($action == 'logout') {
			$this->login->logout();
		}
		else {
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$this->login->doLogin($username, $password);
		}
		
		header("Location: index.php");
	}
}

?>