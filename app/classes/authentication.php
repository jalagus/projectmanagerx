<?php

class AuthenticationUtils { 
    
    public function isLogged() {
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            return true;
        }
        
        return false;
    }
    
}

?>
