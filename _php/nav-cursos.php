<?php  
    require_once (__DIR__.'/'.'../config/dbConfig.php');
    if(!isset($_SESSION)){session_start();} 
    require_once (__DIR__.'/'.'Account.php');
    require_once (__DIR__.'/'.'SuperGlobalChecker.php');
 
        function destroyData(){
            
                unset($userAccount);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                echo($e);
        
        };
error_reporting(E_ALL);
ini_set("display_errors", 1);
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
    <link rel="stylesheet" type="text/css" href="./css/activity-page.css">
    <link rel="stylesheet" type="text/css" href="./css/cursos.css">
    <link rel="stylesheet" type="text/css" href="./css/profile.css">
    <link rel="stylesheet" type="text/css" href="./css/nav-in.css">
    
    <script src="./_scripts/jquery.min.js"></script>
    <script src="./_scripts/angular.js"></script>
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
            <div id="icondiv">
                <img id="tempicon" src="_imagens/wheel.png" onClick="./index.html"><a id="title" href="./index.php">EuMotorista</a>   
            </div>
            <nav id="visual">
               
                
                <li  class="nav-item" id="logoutli">
                    <a href="logout.php"><img id="logout" src="./_imagens/logout-in.png"></a>
                </li>
                
                
            </nav>
        </nav>
    <aside id="menu" class="hidden menu-nav">
        <ul id="menu-items">
            <li id="carteira" style="text-align: center">Minha carteira</li>
            <li id="account"><h3>Perfil-<?php echo $_SESSION['userAccount']['userName'];?></h3></li>
            <li id="logout"><a href="logout.php">Sair</a><img id="logout" src="./_imagens/logout-in.png"></li>
        </ul>
    </aside>
    
    <script>
        var avatar = document.getElementById("avatar");
        var logout = document.getElementById("logout");
        var drop = document.getElementById("menu");
        var sandwich = document.getElementById("drop");
        var isHidden = true;
        var profile = document.getElementById("account");
        var profile2 = document.getElementById("user");
        
        profile.addEventListener("click",function(){
            window.location = 'profile.php';
        });
        avatar.addEventListener('click',function(){
            if(isHidden==true){
                drop.className = "menu show";
                isHidden = false;
            } else {
                drop.className = "menu hidden";
                isHidden = true;
            }
        });
        logout.addEventListener('click',function(){
            console.log("clicou na porta");
        });
    </script>