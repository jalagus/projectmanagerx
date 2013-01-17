<?php

class Hours extends BaseController {

    protected function Index() {
        $viewmodel = new HoursModel();
        $this->ReturnView($viewmodel->Index(), true);
    }
    protected function Add() {
        if (!isset($_POST['projectName'])) {
            $viewmodel = new HoursModel();
            $this->ReturnView($viewmodel->Add(), true);
        }
        else {      
            $userid = $_SESSION['userid'];
            $projectid = $_POST['projectName'];
            $minutes = ($_POST['hours'] * 60) + $_POST['minutes'];
            $date = $_POST['date'];
            
            $model = new HoursModel();
            
            $model->AddHours($userid, $projectid, $minutes, $date);

            $this->ReturnView($model->Add(), true);
        }
    }
}

?>
