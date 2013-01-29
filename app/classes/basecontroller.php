<?php

abstract class BaseController {

    protected $urlvalues;
    protected $action;
    
    protected $viewbag;

    public function __construct($action, $urlvalues) {
        $this->action = $action;
        $this->urlvalues = $urlvalues;
    }

    /*
     * Starts the controller with specified action/page in constructor
     * 
     */
    public function Invoke() {
        return $this->{$this->action}();
    }

    /*
     * Returns the view to be shown
     * 
     * @param bool $fullview if true returns the whole page, if false returns a partial view
     * @param mixed $viewmodel contains the data to be passed to the view
     */
    protected function ReturnView($viewmodel, $fullview) {
        $viewloc = 'views/' . strtolower(get_class($this)) . '/' . strtolower($this->action) . '.php';
        
        $viewbag = $this->viewbag;
        
        if ($fullview) {
            require('views/upperblock.php');
            require($viewloc);
            require('views/lowerblock.php');
        } else {
            require($viewloc);
        }
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
    
    /*
     * Returns error page with custom message
     * 
     * @param string $viewmodel error message
     */
    protected function ReturnError($viewmodel) {        
        $viewloc = BASE_DIR . 'views/error/error.php';

        require(BASE_DIR . 'views/upperblock.php');
        require($viewloc);
        require(BASE_DIR . 'views/lowerblock.php');
    }
}

?>
