<?php

class Authentication extends BaseController {

    protected function Index() {        
        $this->ReturnView("", false);            
    }
    
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
    
    protected function Logout() {
        $_SESSION['logged'] = false;
        session_destroy();
        
        header("Location: " . BASE_DIR);    
    }
}

?>
