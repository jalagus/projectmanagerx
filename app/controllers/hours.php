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
            $projectid =    $_POST['projectid'];
            $hours =        $_POST['hours'];
            $minutes =      $_POST['minutes'];
            $description =  $_POST['description'];
            $date =         $_POST['date'];
            
            $i = 0;
            
            // Transform hours to minutes
            while (isset($hours[$i])) {
                $minuteSum[$i] = ($hours[$i] * 60) + $minutes[$i];
                
                $i++;
            }
            

            $model = new HoursModel();
            
            $model->AddHours($userid, $projectid, $minuteSum, $date, $description);

            $this->ReturnView($model->Add($userid), true);
        }
    }
    
    protected function Delete() {
        $userid = $_SESSION['userid'];
        
        if (isset($_POST['hoursid'])) {
            $hoursId = $_POST['hoursid'];

            $model = new HoursModel();
            $model->Delete($userid, $hoursId);

            $this->Redirect("hours", "index");
        }
        else {
            $hoursId = $_GET['id'];
            
            $viewmodel = new HoursModel();
                        
            $viewdata = $viewmodel->ConfirmDelete($userid, $hoursId);
            
            if ($viewdata != false) {
                $this->ReturnView($viewdata, true);
            }
            else {
                $this->ReturnError("Cannot find project!");
            }            
        }        
    }
}

?>
