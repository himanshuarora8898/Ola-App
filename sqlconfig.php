<?php

Class DBCon{
public $siteurl = "http://localhost/Training/Ola%20app/";
public $dbhost = "localhost";
public $dbuser = "root";
public $dbpass = "";
public $dbname = "Ola";

function __construct(){
	// Create connection


	$this->conn = new mysqli("localhost","root", "", "Ola");

	// Check connection
	if ($this->conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);

	}


}
}
?>	

