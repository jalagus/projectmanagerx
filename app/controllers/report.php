<?php

class Report extends BaseController {

    protected function Index() {
        $viewmodel = new ReportModel();
        $this->ReturnView($viewmodel->Index(), true);
    }

}

?>