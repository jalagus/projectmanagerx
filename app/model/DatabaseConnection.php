<?php

class DatabaseConnection {
	public $connection;
	
	public function __construct($username, $password, $hostname, $database) {
		$this->connection = new mysqli("$hostname", "$username", "$password", "$database") 
			or die("Cannot connect to database"); 
	}

	public function doQuery($queryString) {
		$result = $this->connection->query($queryString);
		
		return $result;
	}

}

?>
