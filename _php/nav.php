<?php 
    require_once (__DIR__.'/'.'../config/dbConfig.php');
?>
<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Capacitação de motoristas de forma gameficada">
    <meta name="keywords" content="Direção,Habilitacao,CNH,Direcao,Habilitação,Auto-Escola">
    <meta name="author" content="Faciweb">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eumotorista: Aprenda a dirigir sem esforços!</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/tela1.css">
    <link rel="stylesheet" type="text/css" href="./css/signup.css">
    <link rel="stylesheet" type="text/css" href="./css/cursos.css">
    <style>
        
    </style>
    <script src="/var/www/html/Eumotorista-WEBPAGE.20/_scripts/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
      // Add smooth scrolling to all links
      $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });
    });
    </script>

</head>
<body id="corpo">

        <nav id="bread-crumbs">
            <img id="tempicon" src="_imagens/wheel.png" onClick="./index.html">
            <a id="title" href="./index.php">EuMotorista</a>
            
        </nav>
        