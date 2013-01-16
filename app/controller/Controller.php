<?php

include_once("model/Login.php");
include_once("model/DatabaseConnection.php");

class Controller {	

	public $login;
	public $database;
	
	public function __construct() {
		$this->database = new DatabaseConnection("root", "root", "localhost", "project_db");
		
		$this->login = new Login($this->database);
	}

	public function invoke() {	
		session_start();
		
		$action = $_POST['action'];
	
		if ($action == 'login') {
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$this->login->doLogin($username, $password);
		}
		else if ($action == 'logout') {
			$this->login->logout();
		}
				
		if ($this->login->isLogged()) {
			include("view/headerBlock.php");
			include("view/main.php");
			include("view/footerBlock.php");
		}
		else {
			include("view/login.php");
		}
	}
}


?>
