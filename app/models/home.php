<?php

class HomeModel extends BaseModel {

    /* 
     * Gets view data for the index view 
     */
    public function Index($userid) {
        $homeObj = new HomeViewmodel();
        
        $homeObj->projectList = $this->getProjectList($userid);
        $homeObj->lastWorkedProject = $this->getLastProject($userid);
        
        return $homeObj;
    }
    
    public function ChangePasswordPost($userid, $oldpassword, $newpassword) {
        
        $oldpassword = sha1(SHA1_SALT . $oldpassword);
        $newpassword = sha1(SHA1_SALT . $newpassword);
        
        $query = $this->database->prepare("UPDATE users SET password = ? WHERE id = ? AND password = ?");
        
        $query->execute(array($newpassword, $userid, $oldpassword));
        
        if ($query->rowCount() > 0) {
            return true;
        }
        
        return false;
    }
    
    private function getProjectList($userid) {
        $query = $this->database->prepare("SELECT projects.name AS projectname, hours.minutes AS minutes, hours.date AS date 
            FROM hours, projects WHERE projects.id = hours.projectid AND hours.userid = ? ORDER BY hours.id DESC");
        
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
            WHERE hours.projectid = projects.id AND hours.userid = ? ORDER BY hours.date DESC");
        
        $query->execute(array($userid)); 
        
        $project = $query->fetchObject();
        
        return $project;         
    }

}

?>
