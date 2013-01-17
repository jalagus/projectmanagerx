<?php

class Project extends BaseController {

    protected function Index() {
        $viewmodel = new ProjectModel();
        $userid = $_SESSION['userid'];
        $this->ReturnView($viewmodel->Index($userid), true);
    }
    
    protected function Add() {
        if (!isset($_POST['projectName'])) {
            $this->ReturnView("", true);
        }
        else {
            $projectName = $_POST['projectName'];
            $projectDescription = $_POST['projectDescription'];
            $userid = $_SESSION['userid'];
            
            $model = new ProjectModel();
            
            $model->Add($userid, $projectName, $projectDescription);
            
            $this->ReturnView("Project added!", true);
        }
    }    
    
    protected function Delete() {
        $projectId = $_POST['projectid'];
        
        $model = new ProjectModel();
        $model->Delete($projectId);
        
        $this->ReturnView("", true);
    }    

}

?>
