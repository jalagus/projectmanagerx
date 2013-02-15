<?php

// Config
require("config.php");

// Base classes
require("classes/loader.php");
require("classes/basecontroller.php");
require("classes/basemodel.php");
require("classes/authentication.php");
require("classes/utils.php");

// Models
require("models/admin.php");
require("models/home.php");
require("models/project.php");
require("models/authentication.php");
require("models/hours.php");
require("models/report.php");
require("models/user.php");
require("models/record.php");

// Specific viewmodels
require("models/projectviewmodel.php");
require("models/hoursviewmodel.php");
require("models/reportviewmodel.php");
require("models/recordviewmodel.php");
require("models/homeviewmodel.php");

// DBModels for saving data
require("models/database/hoursdbmodel.php");
require("models/database/projectdbmodel.php");

// Controllers
require("controllers/admin.php");
require("controllers/home.php");
require("controllers/error.php");
require("controllers/project.php");
require("controllers/authentication.php");
require("controllers/hours.php");
require("controllers/report.php");
require("controllers/record.php");

// Run application
session_start();

$loader = new Loader($_GET);

$controller = $loader->CreateController();

$controller->Invoke();

?>
