<?php

class ProjectModel extends BaseModel {

    public function Index($userid) {
        $query = $this->database->prepare("SELECT
            SUM(hours.minutes) AS minutes, projects.id AS projectid, projects.name AS projectname
            FROM projects, hours 
            WHERE projects.id = hours.projectid AND hours.userid = ?
            GROUP BY projects.id");
        
        $query->execute(array($userid)); 
        
        $projectlist = array();
        
        $i = 0;
        while ($row = $query->fetchObject("HoursViewmodel")) {
            $projectlist[$i++] = $row;
        }
        
        return $projectlist;
    }
    
    public function Add($userid, $projectName, $projectDescription) {
        $query = $this->database->prepare("INSERT INTO projects (userid, name, description) VALUES (?, ?, ?)");
        $query->execute(array($userid, $projectName, $projectDescription));     
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

}

?>
