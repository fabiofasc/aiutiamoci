<?php
session_start();
include "php/db.php";
$user = $_SESSION["user"];
$id = $_GET['id'];

$check = "SELECT Id FROM AnagraficaUtenti WHERE Mail = '".$user."'";
$result=$conn->query($check);
while($row=$result->fetch_assoc()){
  $check = $row['Id'];
}

//if($check == $id)
//{

$query = "SELECT * FROM Ordini WHERE id=".$id;
$result2=$conn->query($query);
while($row2=$result2->fetch_assoc()){
  $negozio = $row2['FKVenditore'];
  $lista = $row2['ListaProdotti'];
  $quantita = $row2['ListaQuantita'];
  $totale = $row2['Totale'];
}


$seller = "SELECT * FROM AnagraficaAttivita WHERE Id=".$negozio;
$result3=$conn->query($seller);
while($row3=$result3->fetch_assoc()){
  $negozio = $row3['NomeAttivita'];
  $indirizzoNegozio = $row3['Indirizzo'];
}
//}

?>


<html lang="en-US" dir="ltr" style="overflow-x: scroll; height: auto;"><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--  
Document Title
=============================================
-->
  <title>SafetyShop - Scontrino</title>
  <!--  
Favicons
=============================================
-->
  <link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicons/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicons/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
  <link type="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <link type="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">


  <link rel="manifest" href="/manifest.json">

  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/images/favicons/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!--  
Stylesheets
=============================================

-->
  <!-- Default stylesheets-->
  <link href="assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Template specific stylesheets-->
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  <link href="assets/lib/animate.css/animate.css" rel="stylesheet">
  <link href="assets/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/lib/et-line-font/et-line-font.css" rel="stylesheet">
  <link href="assets/lib/flexslider/flexslider.css" rel="stylesheet">
  <link href="assets/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
  <link href="assets/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
  <link href="assets/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
  <!-- Main stylesheet and color file-->
  <link href="assets/css/style.css" rel="stylesheet">
  <link id="color-scheme" href="assets/css/colors/default.css" rel="stylesheet">
  </head>
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader" style="display: none;">
        <div class="loader" style="display: none;">Loading...</div>
      </div>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index_shop.html">SafetyShop</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="index_shop.html">Home</a>               
              </li>
              <li class="dropdown">
                <a href="i_miei_ordini.php" >I miei ordini</a>               
              </li>
              <li style="margin-left: 45px;" class="dropdown">
                <a>Utente:<?php echo $user; ?></a>
                <div id="userMail" style="display:none"><?php echo $user; ?></div></li>
            </ul>         
          </div>
        </div>
      </nav>
      <div class="main" style="width:1870px" align="center">
        <h4 style="margin-top: 70px">Nota Bene:<br>
          Alcuni prodotti potrebbero essere vendibili in quantità limitata per ordine.<br>
          Le quantità ed il prezzo totale indicati sullo scontrino<br>
          potrebbero quindi variare a seconda del regolamento del supermercato dal quale si sta acquistando.<br>
          I tempi di consegna possono variare in base alla richiesta da parte degli utenti.<br><br>
          
          <strong>Fai uno screen o salva lo scontrino seguente per mostrarlo alla consegna.</strong>
        </h4>
        <div id="scontrino" align="center" style="background-image: url('assets/images/texture.jpg'); width: fit-content; height: auto; margin-top: 50px; padding: 35px; border: solid 1px black; border-style: dotted">
          <div id="header">
            <h4 style="font-family: initial;"><?php echo $negozio; ?></h4>
            <h5 style="font-family: monospace;">Presso: <?php echo $indirizzoNegozio; ?></h5>
            <p style="font-family: monospace;">Via SafetyShop --- ID Ordine: <?php echo $id;?></p>   
          </div>
          <div id="body">
            <?php
            $ListArr = explode(",",$lista);
            $ListaQta = explode(",",$quantita);
            $x = 0;
            for($i = 0; $i<count($ListArr); $i++){
              echo "<div style='display: flex'><h4 style='width:300px' align='left'>".$ListaQta[$x]." X ".$ListArr[$i]."</h4><h4 style='margin-left: 50px'>".$ListArr[$i+1]."</h4></div>";
              $i++;
              $x++;
            }
            echo "<h4 align='right'><strong>Totale: </strong>".number_format((float)$totale, 2, ',', '')." €</h4>";
            ?>
          </div>
        </div>
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
      <!--  
JavaScripts
=============================================
-->
      <script src="assets/lib/jquery/dist/jquery.js"></script>
      <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
      <script src="assets/lib/wow/dist/wow.js"></script>
      <script src="assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
      <script src="assets/lib/isotope/dist/isotope.pkgd.js"></script>
      <script src="assets/lib/imagesloaded/imagesloaded.pkgd.js"></script>
      <script src="assets/lib/flexslider/jquery.flexslider.js"></script>
      <script src="assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
      <script src="assets/lib/smoothscroll.js"></script>
      <script src="assets/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
      <script src="assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
      <script src="assets/js/plugins.js"></script>
      <script src="assets/js/main.js"></script>