<?php

class Hours extends BaseController {

    protected function Index() {
        $userid = $_SESSION['userid'];
        
        $viewmodel = new HoursModel();
        $this->ReturnView($viewmodel->Index($userid), true);
    }
    protected function Add() {
        $userid = $_SESSION['userid'];
        
        if (!isset($_POST['projectName'])) {
            $viewmodel = new HoursModel();
            $this->ReturnView($viewmodel->Add($userid), true);
        }
        else {      
            $projectid = $_POST['projectName'];
            $minutes = ($_POST['hours'] * 60) + $_POST['minutes'];
            $date = $_POST['date'];
            
            $model = new HoursModel();
            
            $model->AddHours($userid, $projectid, $minutes, $date);

            $this->ReturnView($model->Add($userid), true);
        }
    }
    
    protected function Delete() {
        $hoursId = $_POST['hoursid'];
        
        $model = new HoursModel();
        $model->Delete($hoursId);
        
        $this->ReturnView("", true);
    }
}

?>
