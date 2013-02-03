<?php

class Hours extends BaseController {
    
    private $model;
    
    public function __construct($action, $urlvalues) {
        parent::__construct($action, $urlvalues);
        
        $this->model = new HoursModel();
    }
    
    /*
     * Return the index view of the Hours controller
     */
    protected function Index() {
        $userid = $_SESSION['userid'];

        $this->ReturnView($this->model->Index($userid), true);
    }

    /*
     * Returns add view or saves the data sent to controller
     */
    protected function Add() {
        $userid = $_SESSION['userid'];

        if (!isset($_POST['projectid'])) {
            $this->ReturnView($this->model->Add($userid), true);
        } else {
            $hoursObj = $this->utils->arrayToObject($_POST);

            $this->viewbag = $this->model->AddHours($userid, $hoursObj);

            $this->ReturnView($this->model->Add($userid), true);
        }
    }

    /*
     * Return delete view or deletes the data sent to controller
     */
    protected function Delete() {
        $userid = $_SESSION['userid'];

        if (isset($_POST['hoursid'])) {
            $hoursId = $_POST['hoursid'];

            $model = new HoursModel();
            $model->Delete($userid, $hoursId);

            $this->Redirect("hours", "index");
        } else {
            $hoursId = $_GET['id'];

            $viewdata = $this->model->ConfirmDelete($userid, $hoursId);

            if ($viewdata != false) {
                $this->ReturnView($viewdata, true);
            } else {
                $this->ReturnError("Cannot find hours!");
            }
        }
    }

    /*
     * Returns edit view
     */
    protected function Edit() {
        $userid = $_SESSION['userid'];

        if (isset($_POST['hoursid'])) {
            $hoursObj = $this->utils->arrayToObject($_POST);
                                    
            $result = $this->model->Update($userid, $hoursObj);
            
            if ($result == false) {
                $this->viewbag = "Error on saving!";
            }
            else {
                $this->viewbag = "Data saved!";
            }
            
            $this->ReturnView($this->model->Edit($userid, $hoursObj->hoursid), true); 
            
        } else {
            $hoursid = $_GET['id'];

            $viewdata = $this->model->Edit($userid, $hoursid);
            
            if ($viewdata != false) {
                $this->ReturnView($viewdata, true);
            }
            else {
                $this->ReturnError("Cannot find hours!");
            }
        }
    }

}

?>
