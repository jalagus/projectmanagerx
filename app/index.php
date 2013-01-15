<?php

include_once("controller/Controller.php");
include_once("controller/DatabaseConnection.php");

$db = new DatabaseConnection("username", "password", "localhost", "project_db");

$controller = new Controller();

$controller->invoke();

?>
