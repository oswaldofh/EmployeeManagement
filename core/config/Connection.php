<?php

class Connection{
	var $conn;
	
	function __construct(){
		$this->conn = null;
	}
	
    function connect(){

        $serverName = "localhost";
        $username = "root";
        $password = "";
        $database = "employee";

        $this->conn = new mysqli($serverName, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
?>