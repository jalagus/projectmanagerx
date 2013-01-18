<?php

class ReportModel extends BaseModel {

    public function Index() {
        return array("Reports!", "And more!");
    }
    
    public function Show($userid, $startDate, $endDate) {
        $query = $this->database->prepare("SELECT 
            projects.name AS projectname, hours.minutes AS minutes, hours.date AS date
            FROM hours, projects WHERE projects.id = hours.projectid AND hours.userid = ? 
            AND hours.date >= ? AND hours.date <= ? ORDER BY hours.date DESC");
        
        $query->execute(array($userid, $startDate, $endDate)); 
        
        $hourslist = array();
        
        $i = 0;
        while ($hoursObject = $query->fetchObject("HoursViewmodel")) {
            $hourslist[$i++] = $hoursObject;
        }
        
        $reportModel = new ReportViewmodel();
        $reportModel->enddate = $endDate;
        $reportModel->startdate = $startDate;
        $reportModel->resultlist = $hourslist;
        
        return $reportModel;        
    }

}

?>
