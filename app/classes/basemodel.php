<?php

abstract class BaseModel {

    protected $database;

    /*
     * Initializes model with database connection
     * 
     * Use config.php to change the connection variables
     */
    public function __construct() {
        try {
            $this->database = new PDO(DB_CONNECTION_STRING, DB_USERNAME, DB_PASSWORD);
        }
        catch (PDOException $ex) {
            die("<b>Error in database connection:</b> " . $ex->getMessage());
        }
    }

}

?>
