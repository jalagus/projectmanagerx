<?php

// Main config
define('BASE_DIR', '/');
define('BASE_NAME', "Project Manager X");

// Database variables
define('DB_TYPE','mysql');
define('DB_PASSWORD','root');
define('DB_NAME','project_db');
define('DB_USERNAME','root');
define('DB_HOSTNAME','localhost');

define('DB_CONNECTION_STRING', DB_TYPE . ":host=" . DB_HOSTNAME . ";dbname=" . DB_NAME);

// Themes
define('MAIN_STYLE_FILE', BASE_DIR . 'css/style.css');
define('JQUERY_UI_THEME_FILE', BASE_DIR . 'css/smoothness/jquery-ui-1.10.0.custom.min.css');

?>
