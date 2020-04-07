<?php

include "db.php";
$mail = $_GET['mail'];
$cod = $_GET['cod'];

$query = "UPDATE AnagraficaUtenti SET Abilitato = 1 WHERE Mail = '".$mail."' AND Cvv = ".$cod;
$result=$conn->query($query);

header ("location: ../index_shop.html");
?>