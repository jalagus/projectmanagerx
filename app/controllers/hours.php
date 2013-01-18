<?php

class Hours extends BaseController {

    protected function Index() {
        $userid = $_SESSION['userid'];
        
        $viewmodel = new HoursModel();
        
        $this->ReturnView($viewmodel->Index($userid), true);
    }
    protected function Add() {
        $userid = $_SESSION['userid'];
        
        if (!isset($_POST['projectid'])) {
            $viewmodel = new HoursModel();
            $this->ReturnView($viewmodel->Add($userid), true);
        }
        else {      
            $projectid = $_POST['projectid'];
            
            $hours = $_POST['hours'];
            $minutes = $_POST['minutes'];
            
            $i = 0;
            while (isset($hours[$i])) {
                $minuteSum[$i] = ($hours[$i] * 60) + $minutes[$i];
                $i++;
            }
            
            $date = $_POST['date'];
            
            $model = new HoursModel();
            
            $model->AddHours($userid, $projectid, $minuteSum, $date);

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
