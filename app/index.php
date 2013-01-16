<?php

include_once("controller/MainController.php");
include_once("controller/LoginController.php");
include_once("controller/ProjectController.php");

$controller = $_POST['controller'];

//echo "Controller: " . $controller;

if ($controller == 'login') {
	$loginController = new LoginController();
	$loginController->invoke();
}
else if ($controller == 'project') {
	$projectController = new ProjectController();
	$projectController->invoke();	
}
else {
	$mainController = new MainController();
	$mainController->invoke();
}




?>
