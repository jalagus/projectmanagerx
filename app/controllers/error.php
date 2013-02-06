<?php

class Error extends BaseController {

    /* 
     * Returns error with custom error message
     */
    protected function Index($errormsg) {
        $this->ReturnView($errormsg, true);
    }
    
    /*
     * Returns the error view when user tries to go to url with no controller/action
     */
    protected function BadUrl() {        
        $this->ReturnView("", true);
    }     
}

?>
