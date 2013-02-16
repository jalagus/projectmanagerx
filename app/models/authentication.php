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

}

?>