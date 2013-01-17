<?php

class Report extends BaseController {

    protected function Index() {
        $viewmodel = new ReportModel();
        $this->ReturnView($viewmodel->Index(), true);
    }

    protected function Show() {
        $userid = $_SESSION['userid'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        
        $viewmodel = new ReportModel();
        
        $this->ReturnView($viewmodel->Show($userid, $startDate, $endDate), true);
    }
    
}

?>