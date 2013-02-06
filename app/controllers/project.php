<?php

class Project extends BaseController {

    private $model;
    private $userid;

    public function __construct($action, $urlvalues) {
        parent::__construct($action, $urlvalues);

        $this->model = new ProjectModel();
        $this->userid = $_SESSION['userid'];
    }
    
    /* 
     * Overrides base function and redirects calls with POST variables to 
     * functions with Post-suffixes
     */
    public function Invoke() {        
        if ($_POST) {
            return $this->{$this->action . "Post"}();
        }
        else {
            return $this->{$this->action}();
        }
    }    

    protected function Index() {
        $this->ReturnView($this->model->Index($this->userid), true);
    }

    protected function Add() {
        $this->ReturnView("", true);
    }
    
    protected function AddPost() {
        $projectObj = new ProjectDBModel($this->userid, $_POST['projectName'], 
                $_POST['projectDescription']);

        $result = $this->model->Add($projectObj);

        if ($result != false) {
            $this->viewbag = "Project added!";
            $this->ReturnView("", true);
        } else {
            $this->viewbag = "Project was not added due error!";
            $this->ReturnView($projectObj, true);
        }
    }

    protected function Delete() {
        $projectId = $_GET['id'];

        $viewdata = $this->model->ConfirmDelete($this->userid, $projectId);

        if ($viewdata != false) {
            $this->ReturnView($viewdata, true);
        } else {
            $error = new Error("Index", "");
            $error->ReturnView("Cannot find project!", true);
        }
    }

    protected function DeletePost() {
        $projectId = $_POST['projectid'];

        $this->model->Delete($this->userid, $projectId);

        $this->Redirect("project", "index");
    }

    protected function View() {
        $projectId = $_GET['id'];

        $viewdata = $this->model->View($this->userid, $projectId);

        if ($viewdata != false) {
            $this->ReturnView($viewdata, true);
        } else {
            $error = new Error("Index", "");
            $error->ReturnView("Cannot find project!", true);
        }
    }

    protected function Edit() {
        $projectId = $_GET['id'];

        $viewdata = $this->model->Edit($this->userid, $projectId);

        if ($viewdata != false) {
            $this->ReturnView($viewdata, true);
        } else {
            $error = new Error("Index", "");
            $error->ReturnView("Cannot find project!", true);
        }
    }
    
    protected function EditPost() {
        $projectObj = new ProjectDBModel($this->userid, $_POST['projectName'], 
                $_POST['projectDescription']);
        
        $projectObj->id = $_POST['projectId'];
        
        $this->model->Update($projectObj);

        $viewdata = $this->model->Edit($this->userid, $projectObj->id);
        
        if ($viewdata != false) {
            $this->viewbag = "Data saved!";
            $this->ReturnView($viewdata, true);
        } else {
            $error = new Error("Index", "");
            $error->ReturnView("Cannot find project!", true);
        }
    }

}

?>
