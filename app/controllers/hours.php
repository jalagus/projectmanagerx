<?php

class Hours extends BaseController {

    private $model;
    private $userid;

    public function __construct($action, $urlvalues) {
        parent::__construct($action, $urlvalues);

        $this->model = new HoursModel();
        $this->userid = $_SESSION['userid'];
    }
    
    /* 
     * Overrides the base function and redirects calls with POST variables to 
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
        $this->ReturnView($this->model->Add($this->userid), true);
    }

    /*
     * Saves hours to database
     */

    protected function AddPost() {
        $hoursObj = $this->utils->arrayToObject($_POST);

        $this->viewbag = $this->model->AddHours($this->userid, $hoursObj);

        $this->ReturnView($this->model->Add($this->userid), true);
    }

    /*
     * Return delete view or deletes the data sent to controller
     */

    protected function Delete() {
        $hoursId = $_GET['id'];

        $viewdata = $this->model->ConfirmDelete($this->userid, $hoursId);

        if ($viewdata != false) {
            $this->ReturnView($viewdata, true);
        } else {
            $error = new Error("Index", "");
            $error->ReturnView("Cannot find hours!", true);
        }
    }

    /*
     * Deletes the hours entry
     */

    protected function DeletePost() {
        $hoursId = $_POST['hoursid'];

        $model = new HoursModel();
        $model->Delete($this->userid, $hoursId);

        $this->Redirect("hours", "index");
    }

    /*
     * Returns edit view
     */

    protected function Edit() {
        $hoursid = $_GET['id'];

        $viewdata = $this->model->Edit($this->userid, $hoursid);

        if ($viewdata != false) {
            $this->ReturnView($viewdata, true);
        } else {
            $error = new Error("Index", "");
            $error->ReturnView("Cannot find hours!", true);
        }
    }

    /*
     * Updates the edited hours
     */

    protected function EditPost() {
        $hoursObj = $this->utils->arrayToObject($_POST);

        $result = $this->model->Update($this->userid, $hoursObj);

        if ($result == false) {
            $this->viewbag = "Error on saving!";
        } else {
            $this->viewbag = "Data saved!";
        }

        $this->ReturnView($this->model->Edit($this->userid, $hoursObj->hoursid), true);
    }

}

?>
