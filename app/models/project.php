<?php

class ProjectModel extends BaseModel {

    public function Index() {
        $query = $this->database->prepare("SELECT * FROM projects");
        $query->execute(); 
        
        $projectlist = array();
        
        $i = 0;
        while ($row = $query->fetch()) {
            $projectlist[$i++] = new ProjectViewmodel($row['id'], $row['name']);
        }
        
        return $projectlist;
    }
    
    public function Add($projectName, $projectDescription) {
        $query = $this->database->prepare("INSERT INTO projects (name, description) VALUES (?, ?)");
        $query->execute(array($projectName, $projectDescription));     
    }

}

?>
