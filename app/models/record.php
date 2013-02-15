<?php

class RecordModel extends BaseModel {
    
    private $projectViewmodel;
    private $hoursViewmodel;    
    
    /*
     * Contructor of the record model -object
     */    
    public function __construct() {
        parent::__construct();    
        
        $this->projectViewmodel = new ProjectViewmodel($this->database);
        $this->hoursViewmodel = new HoursViewmodel($this->database);
    }  
    
    
    /*
     * Returns view data used by index view. Return list of projects and 
     * list of recorded hours
     * 
     * @param int $userid id of the user asking the data
     */    
    public function getRecordData($userid) {        
        $recordViewmodel->projectList = $this->projectViewmodel->getList($userid);        
        $recordViewmodel->recordList = $this->getList($userid);     
        
        return $recordViewmodel;
    }
    
    /*
     * Returns id for the recording of hours and saves the base date to 
     * the database
     * 
     * @param int $userid id of the user
     * @param int $projectid id of the project
     * @param int $description work description
     * 
     */
    public function getRecordId($userid, $projectid, $description) {
        $query = $this->database->prepare("INSERT INTO recordedhours (userid, projectid, description, starttime) VALUES (?, ?, ?, NOW() )"); 
        $query->execute(array($userid, $projectid, $description)); 

        if ($query == false) {
            throw new Exception("Error on getting ID");
        }
        else {        
            return $this->database->lastInsertId();        
        }
    }
    
    /*
     * Updates the hours to the database
     * 
     * @param int $userid id of the user
     * @param int $recordid id of the recording
     * 
     */    
    public function SaveRecordedHours($userid, $recordid) {
        $query = $this->database->prepare("UPDATE recordedhours SET endtime = NOW() WHERE userid = ? AND id = ?");
        $query->execute(array($userid, $recordid));
        
        if ($query == false) {
            return false;
        }
        else {
            return date("H:i:s");
        }
    }
    
    /*
     * Updates the recorded hours to the database
     * 
     * @param int $userid id of the user
     * @param int $recordid id of the recording
     * 
     */      
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
    
    /*
     * Deletes the recorded hours from the database
     * 
     * @param int $userid id of the user
     * @param int $recordid id of the recording
     * 
     */     
    public function DeleteRecordedHours($userid, $recordid) {
        $query = $this->database->prepare("DELETE FROM recordedhours WHERE userid = ? AND id = ?");
        
        return $query->execute(array($userid, $recordid));        
    }    
    
    /*
     * Returns the list of recording
     * 
     * @param int $userid id of the user
     * 
     */ 
    public function getList($userid) {
        $query = $this->database->prepare("SELECT r.id AS id, p.name AS projectname, 
            p.id AS projectid, r.description AS description, 
            r.starttime AS starttime, r.endtime AS endtime 
            FROM recordedhours AS r, projects AS p 
            WHERE r.projectid = p.id AND r.userid = ?");
        
        $query->execute(array($userid));       

        $recordedHoursList = array();
        
        $i = 0;
        while ($recordObject = $query->fetchObject("RecordViewmodel")) {
                       
            $recordObject->minutes = floor((strtotime($recordObject->endtime) - strtotime($recordObject->starttime)) / 60);
            $recordObject->date = date("Y-m-d", strtotime($recordObject->starttime));
            $recordedHoursList[$i] = $recordObject; 
            $i++;
        }     
        
        return $recordedHoursList;
    } 

    /*
     * Returns one entry of recorded hours by id
     * 
     * @param int $userid id of the user
     * @param int $hoursid id of the hours
     */     
    public function getById($userid, $hoursid) {
        $query = $this->database->prepare("SELECT r.id AS id, p.name AS projectname, 
            p.id AS projectid, r.description AS description,
            r.starttime AS starttime, r.endtime AS endtime 
            FROM recordedhours AS r, projects AS p 
            WHERE r.projectid = p.id AND r.userid = ? AND r.id = ?");
        
        $query->execute(array($userid, $hoursid));       
        
        $recordObject = $query->fetchObject("RecordViewmodel");
        
        $recordObject->minutes = floor((strtotime($recordObject->endtime) - strtotime($recordObject->starttime)) / 60);
        $recordObject->date = date("Y-m-d", strtotime($recordObject->starttime));

        return $recordObject;
    }     
    
}

?>
