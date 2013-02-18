<?php

class ReportModel extends BaseModel {

    /*
     * Returns view data used by index view. Returns list of hours between the
     * start and end dates
     * 
     * @param int $userid id of the user asking the data
     * @param date $startDate start date
     * @param date $endDate end date
     */    
    public function Index($userid, $startDate, $endDate, $projectId = 0) {
        if ($projectId == 0) {
            $query = $this->database->prepare("SELECT 
                projects.name AS projectname, hours.minutes AS minutes, 
                hours.date AS date, hours.description AS description
                FROM hours, projects WHERE projects.id = hours.projectid AND hours.userid = ? 
                AND hours.date >= ? AND hours.date <= ? ORDER BY hours.date DESC");
            
            $query->execute(array($userid, $startDate, $endDate)); 
        }
        else {
            $query = $this->database->prepare("SELECT 
                projects.name AS projectname, hours.minutes AS minutes, 
                hours.date AS date, hours.description AS description
                FROM hours, projects WHERE projects.id = hours.projectid AND projects.id = ? AND hours.userid = ? 
                AND hours.date >= ? AND hours.date <= ? ORDER BY hours.date DESC");
            
            $query->execute(array($projectId, $userid, $startDate, $endDate));     
        }
                
        $hourslist = array();
        
        $i = 0;
        while ($hoursObject = $query->fetchObject("HoursViewmodel")) {
            $hourslist[$i++] = $hoursObject;
        }
        
        $projectModel = new ProjectViewmodel($this->database);
        
        $reportModel = new ReportViewmodel();
        $reportModel->enddate = $endDate;
        $reportModel->startdate = $startDate;
        $reportModel->resultlist = $hourslist;
        $reportModel->projectlist = $projectModel->getList($userid);
        
        return $reportModel; 
    }

}

?>
