<?php

class HoursViewmodel {
    
    public $id;
    public $userid;
    public $projectname;
    public $projectid;
    public $minutes;
    public $date;
    public $description;
    
    private $database;
    
    /*
     * Contructor of the hours viewmodel -object
     * 
     * @param PDO $database PDO-object of the database
     */    
    public function __construct($database = null) {
        $this->database = $database;
    }
    
    /*
     * Returns list of all hours
     * 
     * @param int $userid id of the user
     */
    public function getList($userid) {
        $query = $this->database->prepare("SELECT 
            p.name AS projectname, p.id AS projectid, h.minutes AS minutes, 
            h.date AS date, h.id AS id, h.description AS description
            FROM hours AS h, projects AS p 
            WHERE h.projectid = p.id AND h.userid = ?
            ORDER BY h.date DESC");
        
        $query->execute(array($userid)); 
        
        $hourslist = array();
        
        $i = 0;
        while ($hoursObject = $query->fetchObject("HoursViewmodel")) {
            $hourslist[$i++] = $hoursObject;
        }
        
        return $hourslist;        
    }
    
    /*
     * Returns one entry of hours by id
     * 
     * @param int $userid id of the user
     * @param int $hoursid id of the hours to be returned 
     */    
    public function getById($userid, $hoursid) {
        $query = $this->database->prepare("SELECT 
            p.name AS projectname, p.id AS projectid, h.minutes AS minutes, 
            h.date AS date, h.id AS id, h.description AS description
            FROM hours AS h, projects AS p 
            WHERE h.projectid = p.id AND h.userid = ? AND h.id = ?
            ORDER BY h.date DESC");
        
        $query->execute(array($userid, $hoursid)); 
        
        return $query->fetchObject("HoursViewmodel");        
    } 

}

?>