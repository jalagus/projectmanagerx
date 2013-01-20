<?php

class Record {

    public $id;
    public $projectid;
    public $projectname;
    
    public $description;
    
    public $minutes;
    public $date;
    
    private $database;
    
    public function __construct($database = null) {
        $this->database = $database;
    }    

    public function getList($userid) {
        $query = $this->database->prepare("SELECT r.id AS id, r.minutes AS minutes, 
            r.date AS date, p.name AS projectname, p.id AS projectid, r.description AS description
            FROM recordedhours AS r, projects AS p 
            WHERE r.projectid = p.id AND r.userid = ?");
        
        $query->execute(array($userid));       

        $recordedHoursList = array();
        
        $i = 0;
        while ($recordObject = $query->fetchObject("Record")) {
            $recordedHoursList[$i] = $recordObject;
            $i++;
        }     
        
        return $recordedHoursList;
    } 

    public function getById($userid, $id) {
        $query = $this->database->prepare("SELECT r.id AS id, r.minutes AS minutes, 
            r.date AS date, p.name AS projectname, p.id AS projectid, r.description AS description
            FROM recordedhours AS r, projects AS p 
            WHERE r.projectid = p.id AND r.userid = ? AND r.id = ?");
        
        $query->execute(array($userid, $id));       
        
        return $query->fetchObject("Record");
    }     
}

?>
