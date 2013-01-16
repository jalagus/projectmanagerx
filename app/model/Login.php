<?php

class Login {

    public $database;

    public function __construct($db) {
        $this->database = $db;
    }

    public function doLogin($username, $password) {
        if (session_id() == '') {
            session_start();
        }
        
        if ($this->checkCredentials($username, $password)) {
            $_SESSION['user'] = $username;

            return true;
        } else {
            return false;
        }
    }

    public function checkCredentials($username, $password) {
        $result = $this->database->doQuery("SELECT id FROM users WHERE username = '$username' AND password='$password'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $_SESSION['userId'] = $row['id'];
                        
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        if (session_id() == '') {
            session_start();
        }

        session_destroy();
        unset($_SESSION['user']);
    }

    public function getUserId() {
        if (session_id() == '') {
            session_start();
        }
        
        return $_SESSION['userId'];
    }

    public function isLogged() {
        if (isset($_SESSION['user'])) {
            return true;
        }

        return false;
    }

}

?>
