<?php

class Record extends BaseController {

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
    
    protected function getRecordId() {
        $userid = $_SESSION['userid'];
        $projectid = $_POST['projectid'];
        $description = $_POST['description'];
        
        $model = new RecordModel(); 
        
        echo $model->getRecordId($userid, $projectid, $description);        
    }
    
    protected function DeleteRecordedHours() {
        $userid = $_SESSION['userid'];
        $recordid = $_POST['recordid'];    
        
        $model = new RecordModel();
        
        $model->DeleteRecordedHours($userid, $recordid);
    }
    
    protected function ConfirmRecordedHours() {
        $userid = $_SESSION['userid'];
        $recordid = $_POST['recordid']; 
        
        $model = new RecordModel();

        $model->ConfirmRecordedHours($userid, $recordid);
    }    
    
}

?>