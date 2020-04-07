<?php

include "db.php";

$mail = trim($_POST['email']);
$nome = trim($_POST['nome']);
$cognome = trim($_POST['cognome']);
$password = md5(trim($_POST['password']));
$cellulare = trim($_POST['cellulare']);
$attivita = trim($_POST['attivita']);
$indirizzo = trim($_POST['indirizzo'])." ,".trim($_POST['civico']);

$cvv = rand(10000,99999); 


$check = "SELECT * FROM `AnagraficaVenditori` WHERE NomeAttivita = '".$attivita."' OR Mail = '".$mail."'";
$resultcheck=$conn->query($check);
$rowcheck = mysqli_fetch_array($resultcheck,MYSQLI_ASSOC);
$countcheck = mysqli_num_rows($resultcheck);


if(!$countcheck){
  //venditore
  $query="INSERT INTO `AnagraficaVenditori`(`Id`, `Mail`, `Nome`, `Cognome`, `Password`, `Cellulare`, `NomeAttivita`, `IndirizzoAttivita`, `Cvv`, `Abilitato`) 
	VALUES (0,'".$mail."','".$nome."','".$cognome."','".$password."','".$cellulare."','".$attivita."','".$indirizzo."', ".$cvv.", 0)";
  $result=$conn->query($query);

  //attivita
  $query2 = "INSERT INTO `AnagraficaAttivita`(`Id`, `NomeAttivita`, `Indirizzo`, `Foto`, `Abilitato`) 
	VALUES (0,'".$attivita."','".$indirizzo."', 'defaultShop.png', 0)";
  $result=$conn->query($query2);
  
  
  
  $link = "http://aiutiamoci.altervista.org/aiutiamoci/php/mailConfirmationSellers.php?mail=".$mail."&cod=".$cvv;
  //Invia mail di conferma
  $headers = 'From: AiutiamociAdministration';
  $msg = "Ciao ".$nome." ".$cognome.",\nquesta mail viene automaticamente generata da Aiutiamoci App.
  \nPer confermare la tua mail ed iniziare a personalizzare la tua attività clicca sul link seguente:\n".$link."\nLa tua attività resterà chiusa e quindi non visibile alla clientela fino a quando non deciderai di aprire.\nPrima di aprire la tua attività ricordati di aggiungere tramite la pagina amministrativa della tua attività tutti i prodotti che vuoi rendere disponibili alla clientela\n\n\nPer informazioni riguardanti l'utilizzo della pagina\no per chiarimenti sul suo funzionamento scrivere a outgate.help@gmail.com.";
  // use wordwrap() if lines are longer than 70 characters
  $msg = wordwrap($msg,70);
  // send email
  mail($mail,"AIUTIAMOCI - CONFERMA MAIL",$msg,$headers);
  
  header ("location: ../conferma_mail.html");

} else {
  header ("location: ../login_register.html?err=2");
}


?>