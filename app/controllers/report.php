<?php

class Report extends BaseController {

    /*
     * Return the index view of the Hours controller
     */      
    protected function Index() {
        $userid = $_SESSION['userid'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        
        $viewmodel = new ReportModel();
        
        $this->ReturnView($viewmodel->Index($userid, $startDate, $endDate), true);
    }    
}

?>