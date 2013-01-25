<?php

class ProjectViewmodel {

    public $id;
    public $name;
    public $description;
    public $minutes;
    
    private $database;
    
    /*
     * Contructor of the project viewmodel -object
     * 
     * @param PDO $database PDO-object of the database
     */       
    public function __construct($database = null) {
        $this->database = $database;
    }       

    /*
     * Returns list of all projects
     * 
     * @param int $userid id of the user
     */    
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
    
    /*
     * Returns one entry of projects by id
     * 
     * @param int $userid id of the user
     * @param int $projectid id of the project to be returned 
     */     
    public function getById($userid, $projectid) {  
        $query = $this->database->prepare("SELECT * FROM projects WHERE userid = ? AND id = ?");
        
        $query->execute(array($userid, $projectid)); 
        
        $project = $query->fetchObject("ProjectViewmodel");
        $project->minutes = $this->getMinutesById($project->id);
        
        return $project;        
    }
    
    /* 
     * Returns total minutes of the project by id
     * 
     * @param int $projectid id of the project
     */
    private function getMinutesById($projectid) {
        $query = $this->database->prepare("SELECT SUM(minutes) AS minutes FROM hours 
            WHERE projectid = ? GROUP BY projectid");
        $query->execute(array($projectid)); 

        $minutesData = $query->fetch();

        return $minutesData['minutes'];        
    }
}

?>
