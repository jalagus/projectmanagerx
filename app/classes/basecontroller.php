<?php

abstract class BaseController {

    protected $urlvalues;
    protected $action;
    
    protected $utils;
    
    protected $viewbag;

    public function __construct($action, $urlvalues) {
        $this->action = $action;
        $this->urlvalues = $urlvalues;
        
        $this->utils = new Utils();
    }

    /*
     * Starts the controller with the specified action/page in constructor
     */
    public function Invoke() {        
        return $this->{$this->action}();
    }

    /*
     * Returns the view to be shown
     * 
     * Automatically removes Post-suffix if present
     * 
     * @param bool $fullview if true returns the whole page, if false returns a partial view
     * @param mixed $viewmodel contains the data to be passed to the view
     */
    protected function ReturnView($viewmodel, $fullview) {
        $parsedAction = $this->removePostFromAction($this->action);
        
        $viewloc = 'views/' . strtolower(get_class($this)) . '/' . strtolower($parsedAction) . '.php';
        
        $viewbag = $this->viewbag;
        
        if ($fullview) {
            require('views/upperblock.php');
            require($viewloc);
            require('views/lowerblock.php');
        } else {
            require($viewloc);
        }
    }
    
    private function removePostFromAction($action) {
        if (strstr($action, "Post")) {
            $action = substr($action, 0, strlen($action) - 4);
        }
        
        return $action;
    }
    
    /*
     * Redirects to specific controller and action
     * 
     * @param string $controller destination controller
     * 
     * @param string $action action to be invoked
     */
    protected function Redirect($controller, $action) {
        header("Location: " . BASE_DIR . $controller . "/" . $action . "/");
    }
}

?>
