<?php
include "db.php";
$prodotti = $_POST['prodotti'];
$acquirente = $_POST['mail'];
$venditore = $_POST['venditore'];
$quantita = $_POST['prezzi'];



//Ricavo l'Id utente
$query = "SELECT Id FROM AnagraficaUtenti WHERE Mail = '".$acquirente."'";
$result=$conn->query($query);
while($row=$result->fetch_assoc())
{
	$acquirente = $row['Id'];
}

//Ricavo la lista prodotti
for($i = 0; $i<count($prodotti); $i++){
  $listaProd = $listaProd.$prodotti[$i].",";
}
$listaProd = substr($listaProd, 0, -1);
//Ricavo la lista quantita
for($i = 0; $i<count($quantita); $i++){
  $listaQta = $listaQta.$quantita[$i][54].",";
}
$listaQta = substr($listaQta, 0, -1);


//Calcolo il totale
for($i = 1; $i<count($prodotti); $i++){
  $prodNoe = str_replace("€", "", $prodotti[$i]);
  $prodNoe = trim($prodNoe);
  $prodInt = (float)$prodNoe;
  $totale = $totale + $prodInt;
  $i++;
}

//Inserisco l'ordine
$insert = "INSERT INTO `Ordini`(`Id`, `Orario`, `FKAcquirente`, `FKVenditore`, `ListaProdotti`, `ListaQuantita`, `Totale`, `Consegnato`, `InCarico`) VALUES 
(0,NOW(),".$acquirente.", ".$venditore.",'".$listaProd."','".$listaQta."',".$totale.",0,0)";
$resultin=$conn->query($insert);


$select = "SELECT * FROM Ordini WHERE FKAcquirente = ".$acquirente." AND FKVenditore = ".$venditore." ORDER BY Orario ASC";
$resultsel=$conn->query($select);
while($rowsel=$resultsel->fetch_assoc())
{
	$ID = $rowsel['Id'];
}

echo $ID;
?>



