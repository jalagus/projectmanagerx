<?php

class HoursModel extends BaseModel {

    public function Index() {
        $query = $this->database->prepare("SELECT projects.name AS name, hours.minutes AS minutes 
            FROM hours, projects WHERE projects.id = hours.projectid");
        
        $query->execute(); 
        
        $hourslist = array();
        
        $i = 0;
        while ($row = $query->fetch()) {
            $hourslist[$i++] = $row['name'] . ": " . $row['minutes'];
        }
        
        return $hourslist;
    }
    
    public function Add() {
        $query = $this->database->prepare("SELECT * FROM projects");
        $query->execute(); 
        
        $projectlist = array();
        
        $i = 0;
        while ($row = $query->fetch()) {
            $projectlist[$i++] = new ProjectViewmodel($row['id'], $row['name']);
        }
        
        return $projectlist;
    }
    
    public function AddHours($userid, $projectid, $minutes, $date) {
        $query = $this->database->prepare("INSERT INTO hours (userid, projectid, minutes, date) VALUES (?, ?, ?, ?)");
        $query->execute(array($userid, $projectid, $minutes, $date));           
    }
}

?>