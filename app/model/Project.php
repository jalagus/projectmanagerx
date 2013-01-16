<?php

class Project {
    public $name;
    public $description;
    
    public function __construct($name, $description) {
        $this->description = $description;
        $this->name = $name;
    }
}
?>
