<?php

class RecordModel extends BaseModel {
    
    private $projectViewmodel;
    private $hoursViewmodel;    
    
    public function __construct() {
        parent::__construct();    
        
        $this->projectViewmodel = new ProjectViewmodel($this->database);
        $this->hoursViewmodel = new HoursViewmodel($this->database);
    }  
    
    public function getRecordData($userid) {        
        $recordViewmodel->projectList = $this->projectViewmodel->getList($userid);        
        $recordViewmodel->recordList = $this->getList($userid);     
        
        return $recordViewmodel;
    }
    
    public function getRecordId($userid, $projectid, $description) {
        $query = $this->database->prepare("INSERT INTO recordedhours (userid, projectid, description, date) VALUES (?, ?, ?, CURDATE() )"); 
        $query->execute(array($userid, $projectid, $description)); 

        if ($query == false) {
            throw new Exception("Error on getting ID");
        }
        else {        
            return $this->database->lastInsertId();        
        }
    }
    
    public function SaveRecordedHours($userid, $recordid, $minutes) {
        $query = $this->database->prepare("UPDATE recordedhours SET minutes = ? WHERE userid = ? AND id = ?");
        $query->execute(array($minutes, $userid, $recordid));
        
        if ($query == false) {
            return false;
        }
        else {
            return date("H:i:s");
        }
    }
    
    public function ConfirmRecordedHours($userid, $recordid) {
        $record = $this->getById($userid, $recordid);
        
        $query = $this->database->prepare("INSERT INTO hours (userid, projectid, minutes, date, description)
            VALUES (?, ?, ?, ?, ?)");
        
        $query->execute(array($userid, $record->projectid, 
            $record->minutes, $record->date, $record->description));
        
        if ($query == false) {
            return false;
        }
        
        $this->DeleteRecordedHours($userid, $recordid);
    }
    
    public function DeleteRecordedHours($userid, $recordid) {
        $query = $this->database->prepare("DELETE FROM recordedhours WHERE userid = ? AND id = ?");
        
        return $query->execute(array($userid, $recordid));        
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
