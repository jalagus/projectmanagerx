<?php

class Record extends BaseController {

    /*
     * Return the index view of the Hours controller
     */     
    protected function Index() {
        $userid = $_SESSION['userid'];
        
        $model = new RecordModel();
        
        $viewdata = $model->getRecordData($userid);
        
        if ($viewdata != false) {
            $this->ReturnView($viewdata, true);
        }
        else {
            $this->ReturnError("Could not load records!");
        }
    }

    /*
     * Saves the recorded hours to database
     */     
    protected function SaveRecordedHours() {
        $minutes = $_POST['minutes'];
        $recordid = $_POST['recordid'];
        $userid = $_SESSION['userid'];
        
        $model = new RecordModel(); 
        
        $viewdata = $model->SaveRecordedHours($userid, $recordid, $minutes);
        
        if ($viewdata != false) {
            echo $viewdata;
        }
        else  {
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
        
        $model = new RecordModel(); 
        
        echo $model->getRecordId($userid, $projectid, htmlspecialchars($description));        
    }
    
    /* 
     * Deletes previously recorded hours from the database
     */
    protected function DeleteRecordedHours() {
        $userid = $_SESSION['userid'];
        $recordid = $_POST['recordid'];    
        
        $model = new RecordModel();
        
        $model->DeleteRecordedHours($userid, $recordid);
    }
    
    /*
     * Confirm the hours by moving the hours from the recorded hours table to 
     * the hours table
     */
    protected function ConfirmRecordedHours() {
        $userid = $_SESSION['userid'];
        $recordid = $_POST['recordid']; 
        
        $model = new RecordModel();

        $model->ConfirmRecordedHours($userid, $recordid);
    }    
    
}

?>