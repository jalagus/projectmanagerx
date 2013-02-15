<?php

class Record extends BaseController {
    
    private $model;

    public function __construct($action, $urlvalues) {
        parent::__construct($action, $urlvalues);
        
        $this->model = new RecordModel();
    }
    
    protected function Index() {
        $userid = $_SESSION['userid'];

        $viewdata = $this->model->getRecordData($userid);

        if ($viewdata != false) {
            $this->ReturnView($viewdata, true);
        } else {
            $error = new Error("Index", "");
            $error->ReturnView("Could not load recorded hours!", true);
        }
    }

    protected function SaveRecordedHours() {
        $minutes = $_POST['minutes'];
        $recordid = $_POST['recordid'];
        $userid = $_SESSION['userid'];

        $viewdata = $this->model->SaveRecordedHours($userid, $recordid);

        if ($viewdata != false) {
            echo $viewdata;
        } else {
            echo "Error saving data..";
        }
    }

    /*
     * Gets new id for recording from the database
     */

    protected function getRecordId() {
        $userid = $_SESSION['userid'];
        $projectid = $_POST['projectid'];
        $description = $_POST['description'];

        echo $this->model->getRecordId($userid, $projectid, htmlspecialchars($description));
    }

    /*
     * Deletes previously recorded hours from the database
     * 
     * Accessed only via ajax so doesn't return any view
     */

    protected function DeleteRecordedHours() {
        $userid = $_SESSION['userid'];
        $recordid = $_POST['recordid'];

        $this->model->DeleteRecordedHours($userid, $recordid);
    }

    /*
     * Confirm the hours by moving the hours from the recorded hours table to 
     * the hours table
     * 
     * Accessed only via ajax so doesn't return any view
     */

    protected function ConfirmRecordedHours() {
        $userid = $_SESSION['userid'];
        $recordid = $_POST['recordid'];

        $this->model->ConfirmRecordedHours($userid, $recordid);
    }

}

?>