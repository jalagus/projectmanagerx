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
            $error = new Authentication("Index", "");
            $errorMsg = '<script>alert("Wrong password or username!");</script>';
            $error->ReturnView($errorMsg, false);
        }
        
    }
    
    protected function Logout() {
        $_SESSION['logged'] = false;
        session_destroy();
        
        header("Location: " . BASE_DIR);    
    }
}

?>
