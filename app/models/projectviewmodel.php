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
        $query = $this->database->prepare("
            SELECT SUM(h.minutes) AS minutes, p.id AS id, p.name AS name, p.description AS description
            FROM hours AS h, projects AS p
            WHERE p.id = h.projectid AND h.userid = ? 
            GROUP BY p.id");
        
        $query->execute(array($userid)); 
        
        $projectlist = array();
        
        $i = 0;
        while ($row = $query->fetchObject("ProjectViewmodel")) {
            $projectlist[$i] = $row;
            $i++;
        }
        
        return $projectlist;        
    }    
    
    public function getById($userid, $projectid) {  
        $query = $this->database->prepare("
            SELECT SUM(h.minutes) AS minutes, p.id AS id, p.name AS name, p.description AS description
            FROM hours AS h, projects AS p
            WHERE p.id = h.projectid AND h.userid = ?  AND p.id = ?
            GROUP BY p.id");
        
        $query->execute(array($userid, $projectid)); 
        
        return $query->fetchObject("ProjectViewmodel");        
    }   
}

?>
