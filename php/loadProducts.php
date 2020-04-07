<?php
include "db.php";
$id = $_GET['id'];
$query = "SELECT * FROM Prodotti WHERE FKAttivita = ".$id." AND Abilitato = 1";
$result=$conn->query($query);
$temp=array();
$datas = "";
$i=0;
while($row=$result->fetch_assoc())
{
  $datas = "[\"".$row['Nome']."\",\"".$row['Prezzo']." €\",\""."<a style='font-size:20px' onclick='add(this)' title='Remove'><i class='fa fa-plus'></i></a>\"]";
  $temp[$i] = (object) array('table' => $datas);
  $i++;
}

echo json_encode($temp);
?>