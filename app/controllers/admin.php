<?php

class Admin extends BaseController {
    
    private $adminModel;
    private $userid;
    
    public function __construct($action, $urlvalues) {
        parent::__construct($action, $urlvalues);    
        
        $this->adminModel = new AdminModel();
        $this->userid = $_SESSION['userid'];
        
        if (!$this->adminModel->isAdmin($this->userid)) {
            die("You must be admin!");
        }
    }
    
    /* 
     * Overrides base function and redirects calls with POST variables to 
     * functions with Post-suffixes
     */
    public function Invoke() {        
        if ($_POST) {
            return $this->{$this->action . "Post"}();
        }
        else {
            return $this->{$this->action}();
        }
    }    
    
    protected function Index() {
        $this->ReturnView($this->adminModel->Index(), true);
    }
    
    protected function AddUser() {
        $this->ReturnView("", true);
    }
    
    
    /*
     * Gets user data and adds the user to database
     * 
     * Return error page on error
     */
    protected function AddUserPost() {
        $username = $_POST['username'];

        $password = $_POST['password'];
        $passwordConfirm = $_POST['confirmpassword'];
        
        if (strlen($password) < 6) {
            $this->ReturnView("Password must be longer than 6 characters!", true);            
        }
        else if ($password == $passwordConfirm) {
            $result = $this->adminModel->AddUserPost($username, $password);
            
            if ($result == false) {
                $this->ReturnView("Error on adding! Try again!", true);
            }
            else {
                $this->Redirect("admin", "index");
            }            
        }
        else {
            $this->ReturnView("Error! Password didn't match!", true);
        }
    }

    protected function DeleteUser() {
        $this->ReturnView($this->adminModel->DeleteUser($_GET['id']), true);
    }
    
    /* 
     * Deletes user data from database
     * 
     * Return error if user cannot be removed
     */
    protected function DeleteUserPost() {
        $userid = $_POST['userid'];
        
        if ($this->adminModel->DeleteUserPost($userid)) {
            $this->Redirect("admin", "index");
        }
        else {
            $error = new Error("Index", "");
            $error->ReturnView("Error on deleting user!", true);
        }
    }

}

?>
