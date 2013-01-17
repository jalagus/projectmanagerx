<?php

class AuthenticationModel extends BaseModel {

    public function checkLogin($username, $password) {
        $query = $this->database->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $query->execute(array($username, $password));

        if ($query->rowCount() > 0) {
            $user = $query->fetch();
            
            $_SESSION['userid'] = $user['id'];
            
            return true;
        } else {
            return false;
        }
    }

}

?>