<?php

class Loader {

    private $controller;
    private $action;
    private $urlvalues;

    /* 
     * Initializes the Loader
     * 
     * Initializes the controller with wanted controller and action. 
     * Checks if the user is logged in and if not, initializes with the 
     * login controller.
     * 
     * @param mixed $urlsvalues values to be used in controller creation
     */
    public function __construct($urlvalues) {
        $this->urlvalues = $urlvalues;
        
        $auth = new AuthenticationUtils();
        
        if (!$auth->isLogged()) {
            $this->controller = "authentication";
        }
        else if ($this->urlvalues['controller'] == "") {
            $this->controller = "home";
        } else {
            $this->controller = $this->urlvalues['controller'];
        }
        if ($this->urlvalues['action'] == "") {
            $this->action = "index";
        } else {
            $this->action = $this->urlvalues['action'];
        }
    }

    /* 
     * Creates the controller
     * 
     * If controller doesn't exist returns error page
     */
    public function CreateController() {
        if (class_exists($this->controller)) {
            
            $parents = class_parents($this->controller);

            if (in_array("BaseController", $parents)) {

                if (method_exists($this->controller, $this->action)) {
                    return new $this->controller($this->action, $this->urlvalues);
                } else {
                    return new Error("BadUrl", $this->urlvalues);
                }
            } 
            else {
                return new Error("BadUrl", $this->urlvalues);
            }
        } 
        else {
            return new Error("BadUrl", $this->urlvalues);
        }
    }

}

?>
