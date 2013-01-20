<?php

class HoursModel extends BaseModel {

    public function Index($userid) {
        $hoursViewmodel = new HoursViewmodel($this->database);
        
        return $hoursViewmodel->getList($userid);;
    }
    
    public function Add($userid) {
        $projectModel = new ProjectViewmodel($this->database);

        return $projectModel->getList($userid);
    }
    
    public function AddHours($userid, $projectid, $minutes, $date, $description) {
        $i = 0;
        
        while (isset($projectid[$i])) {
            if ($minutes[$i] > 0) {
                $query = $this->database->prepare("INSERT INTO hours (userid, projectid, minutes, date, description) VALUES (?, ?, ?, ?, ?)");
                $query->execute(array($userid, $projectid[$i], $minutes[$i], $date[$i], $description[$i])); 
                
                if ($query == false) {
                    throw new Exception("Error on saving data");
                }
            }
            
            $i++;
        }
    }
    
    public function Delete($userid, $hoursid) {
        $query = $this->database->prepare("DELETE FROM hours WHERE id = ? AND userid = ?");
        $query->execute(array($hoursid, $userid));  
        
        if ($query == false) {
            throw new Exception("Error on delete");
        }
    }
    
    public function ConfirmDelete($userid, $hoursid) {
        $hoursViewmodel = new HoursViewmodel($this->database);

        return $hoursViewmodel->getById($userid, $hoursid);        
    }
    
    public function getRecordData($userid) {
        $recordModel = new Record($this->database);
        $projectModel = new ProjectViewmodel($this->database);

        $recordViewmodel = new RecordViewmodel();

        $recordViewmodel->projectList = $projectModel->getList($userid);        
        $recordViewmodel->recordList = $recordModel->getList($userid);     
        
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
            throw new Exception("Error on saving");
        }
        else {
            return date("H:i:s");
        }
    }
    
    public function ConfirmRecordedHours($userid, $recordid) {
        $recordModel = new Record($this->database);
        
        $record = $recordModel->getById($userid, $recordid);
        
        $query = $this->database->prepare("INSERT INTO hours (userid, projectid, minutes, date, description)
            VALUES (?, ?, ?, ?, ?)");
        
        $query->execute(array($userid, $record->projectid, 
            $record->minutes, $record->date, $record->description));
        
        if ($query == false) {
            throw new Exception("Error on confirm");
        }
        
        $this->DeleteRecordedHours($userid, $recordid);
    }
    
    public function DeleteRecordedHours($userid, $recordid) {
        $query = $this->database->prepare("DELETE FROM recordedhours WHERE userid = ? AND id = ?");
        $query->execute(array($userid, $recordid));        
        
        if ($query == false) {
            throw new Exception("Error on delete");
        }
    }
}

?>