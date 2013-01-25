<?php

class Home extends BaseController {

    /*
     * Return the index view of the home controller
     */
    protected function Index() {
        $userid = $_SESSION['userid'];
        
        $viewmodel = new HomeModel();
        $this->ReturnView($viewmodel->Index($userid), true);
    }

}

?>
