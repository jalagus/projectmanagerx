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
        }
        
        header("Location: /");
    }
    
    protected function Logout() {
        $_SESSION['logged'] = false;
        session_destroy();
        
        header("Location: /");
        
    }
}

?>
