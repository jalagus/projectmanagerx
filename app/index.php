<?php

// Base classes
require("classes/loader.php");
require("classes/basecontroller.php");
require("classes/basemodel.php");
require("classes/authentication.php");

// Models
require("models/home.php");
require("models/project.php");
require("models/projectviewmodel.php");
require("models/authentication.php");
require("models/hours.php");

// Controllers
require("controllers/home.php");
require("controllers/error.php");
require("controllers/project.php");
require("controllers/authentication.php");
require("controllers/hours.php");

// Run application
session_start();

$loader = new Loader($_GET);

$controller = $loader->CreateController();

$controller->Invoke();

?>
