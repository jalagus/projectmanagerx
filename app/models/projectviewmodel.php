<?php

class ProjectViewmodel {

    public $id;
    public $name;
    public $description;
    public $minutes;
    
    private $database;
    
    public function __construct($database = null) {
        $this->database = $database;
    }       

    public function getList($userid) {  
        $query = $this->database->prepare("SELECT * FROM projects WHERE userid = ? ORDER BY name ASC");
        
        $query->execute(array($userid)); 
        
        $projectlist = array();
        
        $i = 0;
        while ($row = $query->fetchObject("ProjectViewmodel")) {
            
            $row->minutes = $this->getMinutesById($row->id);
            
            $projectlist[$i] = $row;
            $i++;
        }
        
        return $projectlist;        
    }    
    
    public function getById($userid, $projectid) {  
        $query = $this->database->prepare("SELECT * FROM projects WHERE userid = ? AND id = ?");
        
        $query->execute(array($userid, $projectid)); 
        
        $project = $query->fetchObject("ProjectViewmodel");
        $project->minutes = $this->getMinutesById($project->id);
        
        return $project;        
    }
    
    private function getMinutesById($projectid) {
        $query = $this->database->prepare("SELECT SUM(minutes) AS minutes FROM hours 
            WHERE projectid = ? GROUP BY projectid");
        $query->execute(array($projectid)); 

        $minutesData = $query->fetch();

        return $minutesData['minutes'];        
    }
}

?>
