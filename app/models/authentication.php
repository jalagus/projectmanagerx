<?php

class AuthenticationModel extends BaseModel {

    public function checkLogin($username, $password) {
        $query = $this->database->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $query->execute(array($username, $password));

        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>