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
        } else {
            $projectName = $_POST['projectName'];
            $projectDescription = $_POST['projectDescription'];
            $userid = $_SESSION['userid'];

            $model = new ProjectModel();

            $result = $model->Add($userid, $projectName, $projectDescription);
            
            if ($result != false) {
                $this->ReturnView("Project added!", true);
            }
            else {
                $this->ReturnView("Project was not added due error!", true);                
            }
        }
    }

    protected function Delete() {
        $userid = $_SESSION['userid'];
        
        if (isset($_POST['projectid'])) {
            $projectId = $_POST['projectid'];

            $model = new ProjectModel();
            $model->Delete($userid, $projectId);

            $this->Redirect("project", "index");
        }
        else {
            $projectId = $_GET['id'];
            
            $viewmodel = new ProjectModel();
            
            $viewdata = $viewmodel->ConfirmDelete($userid, $projectId);
            
            if ($viewdata != false) {
                $this->ReturnView($viewdata, true);
            }
            else {
                $this->ReturnError("Could not find selected project");
            }
        }
    }

    protected function View() {
        $projectId =    $_GET['id'];
        $userid =       $_SESSION['userid'];

        $viewmodel = new ProjectModel();
        
        $viewdata = $viewmodel->View($userid, $projectId);
        
        if ($viewdata != false) {
            $this->ReturnView($viewdata, true);
        }
        else {
            $this->ReturnError("Cannot find project!");
        }        
    }

    protected function Edit() {
        $projectId =    $_GET['id'];
        $userid =       $_SESSION['userid'];

        if (isset($_POST['projectId'])) {
            $projectId =    $_POST['projectId'];
            $name =         $_POST['projectName'];
            $description =  $_POST['projectDescription'];

            $model = new ProjectModel();
            $model->Update($userid, $projectId, $name, $description);
        }

        $viewmodel = new ProjectModel();
        $viewdata = $viewmodel->Edit($userid, $projectId);
        
        if ($viewdata != false) {
            $this->ReturnView($viewdata, true);
        }
        else {
            $this->ReturnError("Cannot find project!");
        }
    }
}

?>
