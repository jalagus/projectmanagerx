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

            $model->Add($userid, $projectName, $projectDescription);

            $this->ReturnView("Project added!", true);
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
            
            $this->ReturnView($viewmodel->ConfirmDelete($userid, $projectId), true);
        }

    }

    protected function View() {
        $projectId = $_GET['id'];
        $userid = $_SESSION['userid'];

        $model = new ProjectModel();

        $this->ReturnView($model->View($userid, $projectId), true);
    }

    protected function Edit() {
        $projectId = $_GET['id'];
        $userid = $_SESSION['userid'];

        if (isset($_POST['projectId'])) {
            $projectId = $_POST['projectId'];
            $name = $_POST['projectName'];
            $description = $_POST['projectDescription'];

            $model = new ProjectModel();
            $model->Update($userid, $projectId, $name, $description);
        }

        $viewmodel = new ProjectModel();
                
        $this->ReturnView($viewmodel->Edit($userid, $projectId), true);
    }
}

?>
