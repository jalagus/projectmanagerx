<?php

if ($_GET['action'] == "logout") {
	$login->logout();
}
else {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$login->doLogin($username, $password);
}
header("Location: ../index.php");
?>