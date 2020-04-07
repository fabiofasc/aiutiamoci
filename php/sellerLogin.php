<?php
session_start();
include "db.php";

$mail = $_POST['mail'];
$password = md5($_POST['password']);

$query="SELECT * FROM `AnagraficaVenditori` WHERE Mail = '".$mail."' AND Password = '".$password."' AND Abilitato = 1";
$result=$conn->query($query);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);


if($count > 0){
	$_SESSION["seller"] = $mail;
	header ("location: ../myShop.php");
} else {
	$_SESSION["seller"] = NULL;
	header ("location: ../login_register.html");
}


?>