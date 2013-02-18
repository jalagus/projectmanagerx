<?php

class Home extends BaseController {

    /* 
     * Overrides the base function and redirects calls with POST variables to 
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
        $userid = $_SESSION['userid'];
        
        $viewmodel = new HomeModel();
        $this->ReturnView($viewmodel->Index($userid), true);
    }
    
    protected function ChangePassword() {        
        $this->ReturnView("", true);
    }

    /*
     * Gets new password and changes it
     * 
     * Returns error if there is error changing users password
     */
    protected function ChangePasswordPost() {
        $userid = $_SESSION['userid'];
        
        $viewmodel = new HomeModel();
        
        if ($_POST['newpass'] == $_POST['newpassconfirm']) {
            $result = $viewmodel->ChangePasswordPost($userid, $_POST['oldpass'], $_POST['newpass']);
            
            if ($result) {
                $this->viewbag = "Password changed!";
            }
            else {
                $this->viewbag = "Error on changing password!";
            }
        }
        else {
            $this->viewbag = "Passwords didn't match!";
        }
        
        $this->ReturnView("", true);
    }    
}

?>
