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
    
    public function ConfirmDelete($projectid) {
        $query = $this->database->prepare("SELECT * FROM projects WHERE id = ?");
        $query->execute(array($projectid));
        
        $project = $query->fetchObject("ProjectViewmodel");

        return $project;        
    }
    
    public function Delete($projectid) {
        
        // This should check, if the user is allowed to do the deletion
        
        // Delete project
        $query = $this->database->prepare("DELETE FROM projects WHERE id = ?");
        $query->execute(array($projectid));
        
        // Delete added hours
        $query = $this->database->prepare("DELETE FROM hours WHERE projectid = ?");
        $query->execute(array($projectid));
    }
    
    public function View($id) {
        $query = $this->database->prepare("SELECT * FROM projects WHERE id = ?");
        $query->execute(array($id));
        
        $project = $query->fetchObject("ProjectViewmodel");

        return $project;
    }

    public function Edit($id) {
        $query = $this->database->prepare("SELECT * FROM projects WHERE id = ?");
        $query->execute(array($id));
        
        $project = $query->fetchObject("ProjectViewmodel");

        return $project;        
    }
    
    public function Update($id, $name, $description) {
        
        $query = $this->database->prepare("UPDATE projects SET name = ?, description = ? WHERE id = ?");
        $query->execute(array($name, $description, $id));
    }
}

?>
