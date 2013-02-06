<?php

class Report extends BaseController {
  
    protected function Index() {
        $userid = $_SESSION['userid'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        
        $viewmodel = new ReportModel();
        
        $this->ReturnView($viewmodel->Index($userid, $startDate, $endDate), true);
    }    
}

?>