<?php

class Authentication extends BaseController {

    /*
     * Shows the login view
     * 
     */
    protected function Index() {        
        $this->ReturnView("", false);            
    }
    
    /*
     * Gets the login info, passes it to the model and marks to session
     * that user has logged in
     * 
     */
    protected function Login() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $model = new AuthenticationModel();
        
        if ($model->checkLogin($username, $password)) {
            $_SESSION['logged'] = true;
            
            $this->Redirect("home", "index");
        }
        else {
            $error = new Error("LoginError", "");
            $error->ReturnView("", false);
        }
        
    }
    
    
    /*
     * Deletes the session and logs the user out
     */
    protected function Logout() {
        $_SESSION['logged'] = false;
        session_destroy();
        
        header("Location: " . BASE_DIR);    
    }
}

?>
