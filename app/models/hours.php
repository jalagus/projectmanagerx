<?php

class HoursModel extends BaseModel {

    private $projectViewmodel;
    private $hoursViewmodel;
    
    public function __construct() {
        parent::__construct();    
        
        $this->projectViewmodel = new ProjectViewmodel($this->database);
        $this->hoursViewmodel = new HoursViewmodel($this->database);
    }    
    
    public function Index($userid) {        
        return $this->hoursViewmodel->getList($userid);;
    }
    
    public function Add($userid) {
        return $this->projectViewmodel->getList($userid);
    }
    
    public function AddHours($userid, $projectid, $minutes, $date, $description) {
        $i = 0;
        
        while (isset($projectid[$i])) {
            if ($minutes[$i] > 0) {
                $hoursObj = new HoursDBModel($userid, $projectid[$i], $minutes[$i], $date[$i], $description[$i]);
                
                $query = $this->database->prepare("INSERT INTO hours (id, userid, projectid, minutes, date, description) 
                    VALUES (:id, :userid, :projectid, :minutes, :date, :description)");
                
                $query->execute((array) $hoursObj);
                
                if ($query == false) {
                    throw new Exception("Error on saving data");
                }
            }
            
            $i++;
        }
    }
    
    public function Delete($userid, $hoursid) {
        $query = $this->database->prepare("DELETE FROM hours WHERE id = ? AND userid = ?");
        $query->execute(array($hoursid, $userid));  
        
        if ($query == false) {
            throw new Exception("Error on delete");
        }
    }
    
    public function ConfirmDelete($userid, $hoursid) {
        return $this->hoursViewmodel->getById($userid, $hoursid);        
    }
}

?>