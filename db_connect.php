<?php

$servername = "localhost";
$username = "root"; 
$password = "";
$database = "chatroom";
//Creating Database Connection
$conn = mysqli_connect($servername, $username , $password , $database);
// Checking Connection
if(!$conn)
{
	die("Failed to Connect". mysqli_connect_error());

}

?>
