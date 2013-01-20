<?php

class HoursModel extends BaseModel {

    public function Index($userid) {
        $query = $this->database->prepare("SELECT 
            projects.name AS projectname, hours.minutes AS minutes, 
            hours.date AS date, hours.id AS id, hours.description AS description
            FROM hours, projects 
            WHERE hours.projectid = projects.id AND hours.userid = ?
            ORDER BY hours.date DESC");
        
        $query->execute(array($userid)); 
        
        $hourslist = array();
        
        $i = 0;
        while ($hoursObject = $query->fetchObject("HoursViewmodel")) {
            $hourslist[$i++] = $hoursObject;
        }
        
        return $hourslist;
    }
    
    public function Add($userid) {
        $query = $this->database->prepare("SELECT * FROM projects WHERE userid = ?");
        $query->execute(array($userid)); 
        
        $projectlist = array();
        
        $i = 0;
        while ($row = $query->fetchObject("ProjectViewmodel")) {
            $projectlist[$i++] = $row;
        }
        
        return $projectlist;
    }
    
    public function AddHours($userid, $projectid, $minutes, $date, $description) {
        $i = 0;
        
        while (isset($projectid[$i])) {
            if ($minutes[$i] > 0) {
                $query = $this->database->prepare("INSERT INTO hours (userid, projectid, minutes, date, description) VALUES (?, ?, ?, ?, ?)");
                $query->execute(array($userid, $projectid[$i], $minutes[$i], $date[$i], $description[$i])); 
            }
            
            $i++;
        }
    }
    
    public function Delete($userid, $hoursid) {
        $query = $this->database->prepare("DELETE FROM hours WHERE id = ? AND userid = ?");
        $query->execute(array($hoursid, $userid));        
    }
    
    public function ConfirmDelete($userid, $hoursid) {
        $query = $this->database->prepare("SELECT 
            projects.name AS projectname, hours.minutes AS minutes, hours.date AS date, hours.id AS id
            FROM hours, projects 
            WHERE hours.projectid = projects.id AND hours.id = ? AND hours.userid = ?");
        
        $query->execute(array($hoursid, $userid));
        
        $hours = $query->fetchObject("HoursViewmodel");

        return $hours;        
    }
    
    public function getRecordData($userid) {
        $recordViewmodel = new RecordViewmodel();

        // Get project list
        $query = $this->database->prepare("SELECT * FROM projects WHERE userid = ?"); 
        $query->execute(array($userid));       

        $i = 0;
        while ($projectObject = $query->fetchObject("ProjectViewmodel")) {
            $recordViewmodel->projectList[$i] = $projectObject;
            $i++;
        }
        
        // Get unassigned, but recorded data
        $query = $this->database->prepare("SELECT r.id AS id, r.minutes AS minutes, 
            r.date AS date, p.name AS projectname
            FROM recordedhours AS r, projects AS p 
            WHERE r.projectid = p.id AND r.userid = ?");
        
        $query->execute(array($userid));       

        $i = 0;
        while ($recordObject = $query->fetchObject("Record")) {
            $recordViewmodel->recordList[$i] = $recordObject;
            $i++;
        }   
        
        return $recordViewmodel;
    }
    
    public function getRecordId($userid, $projectid, $description) {
        $query = $this->database->prepare("INSERT INTO recordedhours (userid, projectid, description, date) VALUES (?, ?, ?, CURDATE() )"); 
        $query->execute(array($userid, $projectid, $description)); 
        
        return $this->database->lastInsertId();        
    }
    
    public function SaveRecordedHours($userid, $recordid, $minutes) {
        $query = $this->database->prepare("UPDATE recordedhours SET minutes = ? WHERE userid = ? AND id = ?");
        $query->execute(array($minutes, $userid, $recordid));
        
        return date("H:i:s");
    }
    
    
    public function ConfirmRecordedHours($userid, $recordid) {
        $query = $this->database->prepare("SELECT * FROM recordedhours WHERE userid = ? AND id = ?");
        $query->execute(array($userid, $recordid));
        
        $record = $query->fetchObject("Record");
        
        $query = $this->database->prepare("INSERT INTO hours (userid, projectid, minutes, date, description)
            VALUES (?, ?, ?, ?, ?)");
        
        $query->execute(array($userid, $record->projectid, 
            $record->minutes, $record->date, $record->description));
        
        $this->DeleteRecordedHours($userid, $recordid);
    }
    
    public function DeleteRecordedHours($userid, $recordid) {
        $query = $this->database->prepare("DELETE FROM recordedhours WHERE userid = ? AND id = ?");
        $query->execute(array($userid, $recordid));        
    }
}

?>