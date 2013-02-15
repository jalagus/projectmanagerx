<?php

class AdminModel extends BaseModel {

    public function Index() {
        $query = $this->database->prepare("SELECT * FROM users");
        
        $query->execute();
        
        $userlist = array();
        
        $i = 0;
        
        while ($hoursObject = $query->fetchObject()) {
            $userlist[$i++] = $hoursObject;
        }
        
        return $userlist;
    }
    
    public function DeleteUser($userid) {
        $query = $this->database->prepare("SELECT * FROM users WHERE id = ?");
        
        $query->execute(array($userid));
        
        return $query->fetchObject();
    }
    
    public function DeleteUserPost($userid) {
        $query = $this->database->prepare("DELETE FROM users WHERE id = ?");
        
        $query->execute(array($userid));
        
        if ($query->rowCount() > 0) {
            return true;
        }
        
        return false;        
    }
    
    public function AddUserPost($username, $password) {
        if (!$this->isUsernameFree($username)) {
            return false;
        }

        $password = $username . $password;
        $password = sha1($password);

        $query = $this->database->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $query->execute(array($username, $password));

        return $query;        
    }
    
    private function isUsernameFree($username) {
        $query = $this->database->prepare("SELECT username FROM users WHERE username = ?");
        $query->execute(array($username));

        if ($query->rowCount() > 0) {
            return false;
        }
        else {
            return true;
        }
    }
    
    public function isAdmin($userid) {
        $query = $this->database->prepare("SELECT * FROM users WHERE id = ? AND level = ?");
        
        $query->execute(array($userid, ADMIN_USERLEVEL));
        
        if ($query->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}

?>
