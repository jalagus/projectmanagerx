<?php

abstract class BaseController {

    protected $urlvalues;
    protected $action;

    public function __construct($action, $urlvalues) {
        $this->action = $action;
        $this->urlvalues = $urlvalues;
    }

    /*
     * Starts the controller with specified action/page
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
        $viewloc = 'views/' . get_class($this) . '/' . $this->action . '.php';
        
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
        header("Location: /" . $controller . "/" . $action . "/");
    }
    
    /*
     * Returns error page with custom message
     * 
     * @param string $viewmodel error message
     */
    protected function ReturnError($viewmodel) {
        $viewloc = 'views/error/error.php';

        require('views/upperblock.php');
        require($viewloc);
        require('views/lowerblock.php');
    }
}

?>
