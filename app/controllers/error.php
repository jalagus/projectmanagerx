<?php

class Error extends BaseController {

    protected function BadUrl() {        
        $this->ReturnView("", true);
    }    
    protected function WrongProjectId() {        
        $this->ReturnView("", true);
    }    

}

?>
