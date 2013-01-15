<?php

class DatabaseConnection {

	public function __construct($username, $password, $hostname, $database) {
		mysql_connect("$hostname", "$username", "$password") or die("Cannot connect to database"); 
		mysql_select_db("$database") or die("Cannot select DB");
	}

	public function doQuery($queryString) {
		$queryString = $this->SanitizeForSQL($queryString);

		return mysql_query($queryString, $this->connection);
	}

}

?>
