<?php

class AuthenticationUtils { 
    
    /*
     * Returns login status
     * 
     * @return bool true if logged in, if not, false
     */
    public function isLogged() {
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            return true;
        }
        
        return false;
    }
    
}

?>
