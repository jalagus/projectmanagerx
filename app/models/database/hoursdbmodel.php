<?php

class HoursDBModel {
    
    public $id;
    public $userid;
    public $projectid;
    public $minutes;
    public $date;
    public $description;

    /* 
     * Constructor of the database model of the hours -object
     * 
     * Used for loading and saving data to the database
     */
    public function __construct($userid, $projectid, $minutes, $date, $description) {
        $this->userid = $userid;
        $this->projectid = $projectid;
        $this->minutes = $minutes;
        $this->date = $date;
        $this->description = $description;
        
        $this->id = null;
    }
}

?>
