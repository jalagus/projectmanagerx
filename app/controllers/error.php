<?php

class Error extends BaseController {

    protected function BadUrl() {        
        $this->ReturnView("", true);
    }    

}

?>
