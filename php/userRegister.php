<?php

include "db.php";

$mail = trim($_POST['email']);
$nome = trim($_POST['nome']);
$cognome = trim($_POST['cognome']);
$password = md5(trim($_POST['password']));
$cellulare = trim($_POST['cellulare']);
$indirizzo = trim($_POST['indirizzo'])." ,".trim($_POST['civico']);
$cvv = rand(10000,99999); 

$check = "SELECT * FROM `AnagraficaUtenti` WHERE Mail = '".$mail."'";
$resultcheck=$conn->query($check);
$rowcheck = mysqli_fetch_array($resultcheck,MYSQLI_ASSOC);
$countcheck = mysqli_num_rows($resultcheck);

if(!$countcheck){
  $query="INSERT INTO `AnagraficaUtenti`(`Id`, `Mail`, `Nome`, `Cognome`, `Password`, `Cellulare`, `Indirizzo`, `Cvv`, `Abilitato`) VALUES 
	(0,'".$mail."','".$nome."','".$cognome."','".$password."','".$cellulare."','".$indirizzo."', ".$cvv.",0)";

  $result=$conn->query($query);

  $link = "http://aiutiamoci.altervista.org/aiutiamoci/php/mailConfirmation.php?mail=".$mail."&cod=".$cvv;
  //Invia mail di conferma
  $headers = 'From: aiutiamociShopAdministration';
  $msg = "Ciao ".$nome." ".$cognome.",\nquesta mail viene automaticamente generata da Aiutiamoci App.
  \nPer confermare la tua mail ed iniziare a fare shopping da casa clicca sul link seguente:\n".$link;
  // use wordwrap() if lines are longer than 70 characters
  $msg = wordwrap($msg,70);
  // send email
  mail($mail,"AIUTIAMOCI - CONFERMA MAIL",$msg,$headers);
  
  //reindirizza a pagina di conferma
  header ("location: ../conferma_mail.html");

} else {
  header ("location: ../login_register.html?err=1");
}


?>