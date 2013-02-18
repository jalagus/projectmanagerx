<?php

class AuthenticationModel extends BaseModel {

    /*
     * Checks if login information is correct
     * 
     * Returns true if it is correct otherwise returns false
     */
    public function checkLogin($username, $password) {
        
        // Uses username as a salt
        $hashedSaltedPassword = sha1(SHA1_SALT . $password);
        
        $query = $this->database->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $query->execute(array($username, $hashedSaltedPassword));

        if ($query->rowCount() > 0) {
            $user = $query->fetchObject("User");
            
            $_SESSION['userid'] = $user->id;
            $_SESSION['username'] = $user->username;
            
            return true;
        } else {
            return false;
        }
    }
    
    /*
     * Gets userlevel of current user
     */
    public function getUserlevel() {
        $query = $this->database->prepare("SELECT level FROM users WHERE id = ?");        
        $query->execute(array($_SESSION['userid']));
        
        return $query->fetchObject()->level;
    }

}

?>