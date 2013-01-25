<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Project Manager X</title>
  <meta name="description" content="Project Manager X">
  <meta name="author" content="Jarkko Lagus">
  <link rel="stylesheet" href="css/newuser.css">

</head>
<body>
<div id="container">

<h2> Register new user </h2>
<form action="" method="post">
    Username:<br/>
    <input class="rounded" type="text" name="username" <?php 
        if (isset($_POST['username'])) {
            echo 'value="' . $_POST['username'] . '"'; 
        }
        ?> /><br/>
    
    Password:<br/>
    <input class="rounded" type="password" name="password" /><br/>
    
    Password again:<br/>
    <input class="rounded" type="password" name="confirmpassword" /><br/>
    
    <br/>
    <input class="button" type="submit" value="Create" />
    
</form>

</div>
</body>
</html>

<?php
require("config.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
    if (strlen($_POST['password']) < 6) {
        echo '<script> alert("Password has to be longer than 5 characters!") </script>';
    }
    else {
        if ($_POST['password'] == $_POST['confirmpassword']) {

            if (createUser($_POST['username'], $_POST['password'])) {
                echo '<script> alert("User created succesfully!") </script>';
            }
        }
        else {
            echo '<script> alert("Password didn\'t match!") </script>';
        }
    }
    
}

function createUser($username, $password) {
    if (!isUsernameFree($username)) {
        echo '<script> alert("Username already taken!") </script>';
        return false;
    }
    
    $database = new PDO(DB_TYPE . ":host=" . DB_HOSTNAME . ";dbname=" . DB_NAME, 
            DB_USERNAME, DB_PASSWORD);

    $password = $username . $password;
    $password = sha1($password);

    $query = $database->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $query->execute(array($username, $password));
    
    return $query;
}

function isUsernameFree($username) {
    $database = new PDO(DB_TYPE . ":host=" . DB_HOSTNAME . ";dbname=" . DB_NAME, 
            DB_USERNAME, DB_PASSWORD);

    $query = $database->prepare("SELECT username FROM users WHERE username = ?");
    $query->execute(array($username));

    if ($query->rowCount() > 0) {
        return false;
    }
    else {
        return true;
    }
}

?>