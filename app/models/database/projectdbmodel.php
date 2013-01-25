<?php

class ProjectDBModel {
    
    public $id;
    public $userid;
    public $name;
    public $description;
    
    /* 
     * Constructor of the database model of the project -object
     * 
     * Used for loading and saving data to the database
     */    
    public function __construct($userid, $name, $description) {
        $this->userid = $userid;
        $this->name = $name;
        $this->description = $description;
        
        $this->id = null;
    }
}
?>
