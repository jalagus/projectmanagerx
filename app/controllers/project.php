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

    /*
     * Return the index view of the Hours controller
     */

    protected function Index() {
        $this->ReturnView($this->model->Index($this->userid), true);
    }

    /*
     * Returns add view
     */

    protected function Add() {
        $this->ReturnView("", true);
    }

    /*
     * Adds project to database
     */
    
    protected function AddPost() {
        $projectName = $_POST['projectName'];
        $projectDescription = $_POST['projectDescription'];

        $result = $this->model->Add($this->userid, $projectName, $projectDescription);

        if ($result != false) {
            $this->viewbag = "Project added!";
            $this->ReturnView("", true);
        } else {
            $projectData = new ProjectDBModel($this->userid, $projectName, $projectDescription);

            $this->viewbag = "Project was not added due error!";
            $this->ReturnView($projectData, true);
        }
    }

    /*
     * Returns delete view
     */

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

    /*
     * Deletes project
     */

    protected function DeletePost() {

        $projectId = $_POST['projectid'];

        $this->model->Delete($this->userid, $projectId);

        $this->Redirect("project", "index");
    }

    /*
     * Returns View -view
     */

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

    /*
     * Returns edit view
     */

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

    /*
     * Updates project data
     */

    protected function EditPost() {
        $projectId = $_POST['projectId'];
        $name = $_POST['projectName'];
        $description = $_POST['projectDescription'];

        $this->model->Update($this->userid, $projectId, $name, $description);

        $viewdata = $this->model->Edit($this->userid, $projectId);

        if ($viewdata != false) {
            $this->ReturnView($viewdata, true);
        } else {
            $error = new Error("Index", "");
            $error->ReturnView("Cannot find project!", true);
        }
    }

}

?>
