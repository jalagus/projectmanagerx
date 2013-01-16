<?php

class Auth { 
    
    public function isLogged() {
        if ($_SESSION['logged'] == true) {
            return true;
        }
        
        return false;
    }
    
}

?>
