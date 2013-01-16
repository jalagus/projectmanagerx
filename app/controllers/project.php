<?php

class Project extends BaseController {

    protected function Index() {
        $viewmodel = new ProjectModel();
        $this->ReturnView($viewmodel->Index(), true);
    }
    
    protected function Add() {
        if (!isset($_POST['projectName'])) {
            $this->ReturnView("", true);
        }
        else {
            $projectName = $_POST['projectName'];
            $projectDescription = $_POST['projectDescription'];
            
            $model = new ProjectModel();
            
            $model->Add($projectName, $projectDescription);
            
            $this->ReturnView("Project added!", true);
        }
    }    

}

?>
