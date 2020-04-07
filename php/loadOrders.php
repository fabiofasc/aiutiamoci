<?php
include "db.php";
$user = $_GET['user'];

$query = "SELECT Id FROM AnagraficaUtenti WHERE Mail ='".$user."'";
$result=$conn->query($query);
while($row=$result->fetch_assoc())
{
  $idUtente = $row['Id'];
}



$load = "SELECT * FROM Ordini WHERE FKAcquirente = ".$idUtente;
$result2=$conn->query($load);
$temp=array();
$datas = "";
$i=0;
$stato = "";
while($row2=$result2->fetch_assoc())
{
  if($row2['Consegnato']){
    $stato = "<h4 style='color: green;text-transform: uppercase;'>Consegnato</h4>";
  } else {
    if($row2['InCarico']){
      $stato = "<h4 style='color: #ff8200;text-transform: uppercase;'>Preso in carico</h4>";
    } else {
      $stato = "<h4 style='color: gray;text-transform: uppercase;'>Ordine in attesa di revisione</h4>";
    }
  }

  $seller = "SELECT NomeAttivita FROM AnagraficaAttivita WHERE Id = ".$row2['FKVenditore'];
  $result3=$conn->query($seller);
  while($row3=$result3->fetch_assoc())
  {
    $venditore = $row3['NomeAttivita'];
  }

  $datas = "[\"".$row2['Id']."\",\"".$row2['Orario']."\",\"".$venditore."\",\"".$stato."\",\"<a class='btn btn-b btn-round' style='letter-spacing: unset; padding: 6px 12px;' href='scontrino.php?id=".$row2['Id']."'>Visualizza Scontrino</a>\"]";
  $temp[$i] = (object) array('table' => $datas);
  $i++;
}

echo json_encode($temp);
?>