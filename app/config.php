<?php

// Main config
define('BASE_DIR', '/');
define('BASE_NAME', "Project Manager X");

define('ADMIN_USERLEVEL', 100);

define('SHA1_SALT', "PRMX");

// Set include path to BASE_DIR
set_include_path(BASE_DIR);

// Database variables
define('DB_TYPE','mysql');
define('DB_PASSWORD','root');
define('DB_NAME','project_db');
define('DB_USERNAME','root');
define('DB_HOSTNAME','localhost');
define('DB_CONNECTION_STRING', DB_TYPE . ":host=" . DB_HOSTNAME . ";dbname=" . DB_NAME);
?>
