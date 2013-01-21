<?php

require("config.php");

$db = new PDO("mysql:host=" . DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);

$query = $db->prepare("CREATE DATABASE ?");
$query->execute(array("testi_db"));

?>
