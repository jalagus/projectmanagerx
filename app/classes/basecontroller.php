<?php

abstract class BaseController {

    protected $urlvalues;
    protected $action;

    public function __construct($action, $urlvalues) {
        $this->action = $action;
        $this->urlvalues = $urlvalues;
    }

    public function Invoke() {
        return $this->{$this->action}();
    }

    protected function ReturnView($viewmodel, $fullview) {
        $viewloc = 'views/' . get_class($this) . '/' . $this->action . '.php';
        
        if ($fullview) {
            require('views/upperblock.php');
            require($viewloc);
            require('views/lowerblock.php');
        } else {
            require($viewloc);
        }
    }
    
    protected function Redirect($controller, $action) {
        header("Location: /" . $controller . "/" . $action . "/");
    }
    
    protected function ReturnViewWithError($viewmodel, $error, $fullview) {
        $viewloc = 'views/' . get_class($this) . '/' . $this->action . '.php';
        
        if ($fullview) {
            require('views/upperblock.php');
            require($viewloc);
            require('views/lowerblock.php');
        } else {
            require($viewloc);
        }
    }
}

?>
