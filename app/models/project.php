<?php

class ProjectModel extends BaseModel {

    public function Index($userid) {
        $query = $this->database->prepare("SELECT name AS projectname, id AS projectid FROM projects WHERE userid = ?");
        
        $query->execute(array($userid)); 
        
        $projectlist = array();
        
        $i = 0;
        while ($row = $query->fetchObject("HoursViewmodel")) {
            $minuteQuery = $this->database->prepare("SELECT SUM(minutes) AS minutes FROM hours WHERE projectid = ? GROUP BY projectid");
            $minuteQuery->execute(array($row->projectid));
            $project = $minuteQuery->fetch();
            
            $row->minutes = $project['minutes'];
            
            $projectlist[$i++] = $row;
        }
        
        return $projectlist;
    }
    
    public function Add($userid, $projectName, $projectDescription) {
        $query = $this->database->prepare("INSERT INTO projects (userid, name, description) VALUES (?, ?, ?)");
        $query->execute(array($userid, $projectName, $projectDescription));     
    }
    
    public function ConfirmDelete($userid, $projectid) {
        $query = $this->database->prepare("SELECT * FROM projects WHERE id = ? AND userid = ?");
        $query->execute(array($projectid, $userid));
        
        $project = $query->fetchObject("ProjectViewmodel");

        return $project;        
    }
    
    public function Delete($userid, $projectid) {
                
        // Delete project
        $query = $this->database->prepare("DELETE FROM projects WHERE id = ? AND userid = ?");
        $query->execute(array($projectid, $userid));
        
        // Delete added hours
        $query = $this->database->prepare("DELETE FROM hours WHERE projectid = ? AND userid = ?");
        $query->execute(array($projectid, $userid));
    }
    
    public function View($userid, $id) {
        $query = $this->database->prepare("SELECT * FROM projects WHERE id = ? AND userid = ?");
        $query->execute(array($id, $userid));
        
        $project = $query->fetchObject("ProjectViewmodel");

        return $project;
    }

    public function Edit($userid, $id) {
        $query = $this->database->prepare("SELECT * FROM projects WHERE id = ? AND userid = ?");
        $query->execute(array($id, $userid));
        
        $project = $query->fetchObject("ProjectViewmodel");

        return $project;        
    }
    
    public function Update($userid, $id, $name, $description) {       
        $query = $this->database->prepare("UPDATE projects SET name = ?, description = ? WHERE id = ? AND userid = ?");
        $query->execute(array($name, $description, $id, $userid));
    }
}

?>
