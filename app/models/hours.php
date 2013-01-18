<?php

class HoursModel extends BaseModel {

    public function Index($userid) {
        $query = $this->database->prepare("SELECT 
            projects.name AS projectname, hours.minutes AS minutes, hours.date AS date, hours.id AS id
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
    
    public function AddHours($userid, $projectid, $minutes, $date) {
        $i = 0;
        
        while (isset($projectid[$i])) {
            $query = $this->database->prepare("INSERT INTO hours (userid, projectid, minutes, date) VALUES (?, ?, ?, ?)");
            $query->execute(array($userid, $projectid[$i], $minutes[$i], $date[$i])); 
            
            $i++;
        }
    }
    
    public function Delete($hoursid) {
        $query = $this->database->prepare("DELETE FROM hours WHERE id = ?");
        $query->execute(array($hoursid));        
    }
}

?>