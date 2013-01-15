<?php

class Controller {	
	public function __construct() {

	}

	public function invoke() {
		$page = $_GET['page'];
	
		include("view/headerBlock.php");
		
		$this->loadPage($page);
		
		include("view/footerBlock.php");
	}

	public function loadPage($pageName) {
		if ($pageName == "login") {
			include("view/login.php");
		}
		else {
			include("view/main.php");
		}	
	}
}


?>