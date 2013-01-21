<?php

abstract class BaseModel {

    protected $database;

    /*
     * Initializes model with database connection
     * 
     * Use config.php to change the connection parameters
     */
    public function __construct() {
        $this->database = new PDO(DB_TYPE . ":host=" . DB_HOSTNAME . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    }

}

?>
