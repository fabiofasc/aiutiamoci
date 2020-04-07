<?php
session_start();
include "php/db.php";

if($_SESSION["user"] == ""){
  header("location: login_register.html");
}
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr" style="overflow-x:scroll">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--  
Document Title
=============================================
-->
    <title>SafetyShop - I miei ordini</title>
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
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index_shop.html">SafetyShop</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="index_shop.html" >Home</a>               
              </li>
              <li class="dropdown">
                <a href="php/logout.php" >Logout</a>
              </li>
              <li style="margin-left: 45px;" class="dropdown">
                <?php
                echo "<a>Utente:".$_SESSION["user"]."</a>";
                echo "<div id='userMail' style='display:none'>".$_SESSION["user"]."</div>";
                ?>
              </li>
            </ul>         
          </div>
        </div>
      </nav>
      <div class="main">
        <section class="module">

          <!-- TABELLA ORDINI -->
          <div id="mainContainerForOrders">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt">I miei ordini</h1>
              </div>
            </div>
            <hr class="divider-w pt-20">
            <div align="center">
              <div class="col-sm-12">
                <table id="dt-orders" class="table table-striped table-border checkout-table">                  
                  <thead>
                    <tr>                      
                      <th>ID Ordine</th>
                      <th>Data ordine</th>
                      <th>Venditore</th>
                      <th>Stato ordine</th>
                      <th>Scontrino</th>
                    </tr> 
                  </thead>
                  <tbody>                   
                  </tbody>
                  <tfoot>
                    <tr>                      
                      <th>ID Ordine</th>
                      <th>Data ordine</th>
                      <th>Venditore</th>
                      <th>Stato ordine</th>
                      <th>Scontrino</th>
                    </tr> 
                  </tfoot>
                </table>
              </div>
            </div>              
          </div>
          <!-- FINE PRODOTTI -->             
        </section>
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

        <script>
          var dataSet = [];

          $(document).ready(function() {
            var user = document.getElementById("userMail").innerHTML.toString();
            $.ajax({url: "php/loadOrders.php?user=" + user, success: function(result){
              result = JSON.parse(result);
              for(var i = 0; i<result.length; i++){
                dataSet.push(JSON.parse(result[i].table));
              }
              creaTabelle();
            }});

          });         

          function creaTabelle(){
            $('#dt-orders').DataTable( {
              "oLanguage":{ "sUrl" : "//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"},
              data: dataSet,
              columns: [{ title: "IDOrdine" },{ title: "Data ordine" },{ title: "Venditore" } ,{ title: "StatoOrdine" }, { title: "Scontrino"}]
            } );

          }
        </script>
        </body>
      </html>

    <style>
      .sorting_1{
        width: 250px !important;
        max-width: unset !important;
        min-width: 250px !important;
      }
    </style>