<?php

class HomeModel extends BaseModel {

    public function Index($userid) {
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

}

?>
