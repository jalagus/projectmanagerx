<?php

class Home extends BaseController {

    protected function Index() {
        $userid = $_SESSION['userid'];
        
        $viewmodel = new HomeModel();
        $this->ReturnView($viewmodel->Index($userid), true);
    }

}

?>
