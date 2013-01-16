<?php

abstract class BaseModel {

    protected $database;

    public function __construct() {
        $this->database = new PDO("mysql:host=localhost;dbname=project_db", "root", "root");
    }

}

?>
