<?php

class ProjectDBModel {
    
    public $id;
    public $userid;
    public $name;
    public $description;
    
    public function __construct($userid, $name, $description) {
        $this->userid = $userid;
        $this->name = $name;
        $this->description = $description;
        
        $this->id = null;
    }
}
?>
