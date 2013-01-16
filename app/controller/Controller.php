<?php

include_once("model/Login.php");
include_once("model/DatabaseConnection.php");

abstract class Controller {	

	public $login;
	public $database;
	
	abstract public function invoke();
	
	public function __construct() {
		$this->database = new DatabaseConnection("root", "root", "localhost", "project_db");
		
		$this->login = new Login($this->database);
	}

	
}


?>
