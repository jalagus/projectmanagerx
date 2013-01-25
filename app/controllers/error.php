<?php

class Error extends BaseController {

    /*
     * Returns the error view when user tries to go to url with no controller/action
     */
    protected function BadUrl() {        
        $this->ReturnView("", true);
    }     

}

?>
