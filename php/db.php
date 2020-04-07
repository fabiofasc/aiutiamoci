<?php
$servername = "localhost";
$user = "root";
$pass = "";
$name = "my_aiutiamoci";

$conn = new mysqli($servername,$user,$pass,$name);
$conn->set_charset('utf8mb4');

if ($conn->connect_error){
	die("errore: ".$conn->connect_error);
}
?>