<?php

class HomeModel extends BaseModel {

    /* 
     * Gets view data for the index view 
     */
    public function Index($userid) {
        $homeObj = new HomeViewmodel();
        
        $homeObj->projectList = $this->getProjectList($userid);
        $homeObj->lastWorkedProject = $this->getLastProject($userid);
        $homeObj->mostWorkedProject = $this->getMostWorkedProject($userid);
        
        return $homeObj;
    }
    
    private function getProjectList($userid) {
        $query = $this->database->prepare("SELECT projects.name AS projectname, hours.minutes AS minutes 
            FROM hours, projects WHERE projects.id = hours.projectid AND hours.userid = ?");
        
        $query->execute(array($userid)); 
        
        $hourslist = array();
        
        $i = 0;
        while ($hoursObject = $query->fetchObject("HoursViewmodel")) {
            $hourslist[$i++] = $hoursObject;
        }
        
        return $hourslist;        
    }
    
    private function getLastProject($userid) {
        $query = $this->database->prepare("SELECT hours.date AS date, projects.name AS name, projects.id AS id FROM hours, projects
            WHERE hours.projectid = projects.id AND hours.userid = ? ORDER BY hours.date ASC");
        
        $query->execute(array($userid)); 
        
        $project = $query->fetchObject();
        
        return $project;         
    }

    private function getMostWorkedProject($userid) {
        $query = $this->database->prepare("SELECT hours.date AS date, projects.name AS name FROM hours, projects
            WHERE hours.projectid = projects.id AND hours.userid = ? ORDER BY hours.date ASC");
        
        $query->execute(array($userid)); 
        
        $project = $query->fetchObject();
        
        return $project->name;  
    }
}

?>
