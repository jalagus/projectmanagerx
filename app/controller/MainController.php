<?php

include_once("controller/Controller.php");

class MainController extends Controller {	

	public function invoke() {	
		session_start();
		
		$action = $_POST['action'];
				
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
