<?php
session_start();
include "db.php";

$mail = $_POST['mail'];
$password = md5($_POST['password']);

$query="SELECT * FROM `AnagraficaUtenti` WHERE Mail = '".$mail."' AND Password = '".$password."' AND Abilitato = 1";

$result=$conn->query($query);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
var_dump($row);

if($count > 0){
	$_SESSION["user"] = $mail;
	$_SESSION["cuori"] = $row['cuori'];
	header ("location: ../shop_product_col_3.php");
}else {
	$_SESSION["user"] = NULL;
	header ("location: ../login_register.html");
}

?>