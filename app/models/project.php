<?php

class ProjectModel extends BaseModel {
    
    private $projectViewmodel;

    public function __construct() {
        parent::__construct();    
        
        $this->projectViewmodel = new ProjectViewmodel($this->database);
    }

    public function Index($userid) {         
        return $this->projectViewmodel->getList($userid);
    }
    
    public function Add($userid, $projectName, $projectDescription) {
        $query = $this->database->prepare("INSERT INTO projects (userid, name, description) VALUES (?, ?, ?)");
        $query->execute(array($userid, $projectName, $projectDescription));     
    }
    
    public function ConfirmDelete($userid, $id) {
        return $this->projectViewmodel->getById($userid, $id);      
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
        return $this->projectViewmodel->getById($userid, $id);
    }

    public function Edit($userid, $id) {
        return $this->projectViewmodel->getById($userid, $id);        
    }
    
    public function Update($userid, $id, $name, $description) {       
        $query = $this->database->prepare("UPDATE projects SET name = ?, description = ? WHERE id = ? AND userid = ?");
        $query->execute(array($name, $description, $id, $userid));
    }
}

?>
