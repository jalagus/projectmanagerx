<?php

class ProjectModel extends BaseModel {

    public function Index($userid) {
        $query = $this->database->prepare("SELECT * FROM projects WHERE userid = ?");
        $query->execute(array($userid)); 
        
        $projectlist = array();
        
        $i = 0;
        while ($row = $query->fetch()) {
            $projectlist[$i++] = new ProjectViewmodel($row['id'], $row['name']);
        }
        
        return $projectlist;
    }
    
    public function Add($userid, $projectName, $projectDescription) {
        $query = $this->database->prepare("INSERT INTO projects (userid, name, description) VALUES (?, ?, ?)");
        $query->execute(array($userid, $projectName, $projectDescription));     
    }
    
    public function Delete($projectid) {
        $query = $this->database->prepare("DELETE FROM projects WHERE id = ?");
        $query->execute(array($projectid));   
    }

}

?>
