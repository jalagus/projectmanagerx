<?php

abstract class BaseModel {

    protected $database;

    public function __construct() {
        $this->database = new PDO("mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    }

}

?>
