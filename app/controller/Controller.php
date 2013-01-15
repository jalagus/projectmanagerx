<?php

class Controller {	
	public function __construct() {
		session_start();

	}

	public function invoke() {
		$page = $_GET['page'];

		if ($_SESSION['user'] == "test") {
			$logged = true;
		}
	
		if ($logged == true) {
			include("view/headerBlock.php");
			$this->loadPage($page);
			include("view/footerBlock.php");
		}
		else {
                        include("view/headerBlock.php");
                        $this->loadPage("login");
                        include("view/footerBlock.php");
		}
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
