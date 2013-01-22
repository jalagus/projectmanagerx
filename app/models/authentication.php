<?php

class AuthenticationModel extends BaseModel {

    public function checkLogin($username, $password) {
        
        // Uses username as salt
        $hashedSaltedPassword = sha1($username . $password);
        
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