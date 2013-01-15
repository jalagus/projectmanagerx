<?php

class Controller {	
	public function __construct() {

	}

	public function invoke() {
		$page = $_GET['page'];
	
		if ($page == "books") {
			echo "Boooooooks!";
		}
		else {
			//include("views/main.php");
			
			echo "Main!";
		}
	}
	
}

?>