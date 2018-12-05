
<!DOCTYPE html>
<html lang="br">
<?php
    if(!isset($_SESSION)){session_start();} 
	
	require_once (__DIR__.'/'.'_php/Account.php');
	require_once (__DIR__.'/'.'_php/SuperGlobalChecker.php');
    $sessionChecker = new SuperGlobalChecker(7);
	$sessionChecker->addObject("userAccount");
	$existenceTest = $sessionChecker->testExistence();
	if(!$existenceTest){header("Location: index.php?error");}
	else{
		try{
            $userAccount = Account::unsessionate($_SESSION['userAccount']);
            if($userAccount->getTheme() == null){header("Location: cursos.php");}
        }
        catch(Exception $e){header("Location: index.php?error");}
	}
?>

<?php  
    require_once (__DIR__.'/'.'/config/dbConfig.php');
    if(!isset($_SESSION)){session_start();} 
 
        function destroyData(){
            
                unset($userAccount);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                echo($e);
        
        };
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<head>
    <meta charset="utf-8">
    <meta name="description" content="Capacitação de motoristas de forma gameficada">
    <meta name="keywords" content="Direção,Habilitacao,CNH,Direcao,Habilitação,Auto-Escola">
    <meta name="author" content="Faciweb">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eumotorista: Aprenda a dirigir sem esforços!</title>
    
    <link rel="stylesheet" type="text/css" href="./css/activity-page.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/tela1.css">
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
<body id="corpo-profile">
        <nav id="bread-crumbs">
            <div id="icondiv">
                <img id="tempicon" src="_imagens/wheel.png" onClick="./index.html"><a id="title" href="./index.php">EuMotorista</a>   
            </div><span id="ham" style=" color:white;">☰</span>
            <nav id="visual" class="hide">
               
                <li  class="nav-item" id="training">
                    <div id="TSDiv" class="nav-link"><h2>Sessão de Treinamento</h2></div>
                </li>
                <li  class="nav-item" id="studyMaterial">
                    <div id="SMDiv" class="nav-link"><h2>Material de Estudo</h2></div>
                </li>
                <li  class="nav-item" id="user">
                    <img id="avatar" src="./avatars/<?php echo $_SESSION['userAccount']['pictureId'] ?>.png"><h3 id="nav-username"><?php echo $_SESSION['userAccount']['userName'];?></h3><p id="arrow">></p>
                </li>
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
        var arrow = document.getElementById("arrow");
        var ham = document.getElementById("ham");
        var navDrop = document.getElementById("visual");
        var corpo = document.getElementById("corpo");
        
        var navHidden= true;
        
        profile.addEventListener("click",function(){
            window.location = 'profile.php';
        });
        
        
        ham.addEventListener('click',function(){
            if(navHidden==true){
                navDrop.className = "show";
                navHidden = false;
                
            } else {
                navDrop.className = "hide";
                navHidden = true;
            }
        });
        
        corpo.addEventListener('click',function(evt){
            if(evt.target.id=="ham"){
                
                 navDrop.className = "show";
                 navHidden = false;
            } else {
                if(navHidden==false){
                    navDrop.className = "hide";
                    navHidden = true;
                }
            }
            if(evt.target.id=="visual"){
                corpo.removeEventListener('click');
            }
            
            if(evt.target.id=="user"){
                drop.className = "menu show";
                isHidden = false;
            }
        });
        
        arrow.addEventListener('click',function(){
            if(isHidden==true){
                drop.className = "menu show";
                isHidden = false;
            } else {
                drop.className = "menu hidden";
                isHidden = true;
            }
        });
        
        profile2.addEventListener('click',function(){
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
    
    <header id="profile-header"></header>
    <main id="profile-main">
        <h2>Informações sobre o seu Perfil:</h2>
         <div id="avatar-div"><p>Selecione seu avatar:</p>
            <div id='avatars'><?php
                    $directory = "avatars/";
                    $images = glob($directory . "/*.png");
                    $i=1;
                    foreach($images as $image)
                    {
                      echo "<img class='avatars' id='$i' src='$image' alt='avatars$i' >";
                        $i++;
                    }
                    ?>
            </div>
            <div id="update-alert"></div>
        </div>
        <script>
            var upAlert= document.getElementById("update-alert");
            var avatarDiv = document.getElementById("avatar-div");
            var avatarId="";

            avatarDiv.addEventListener('click',function(event){
               avatarId = event.target.id;

                $.ajax({
                            type:'post',
                            url:'changeAvatar.php',
                            data:{'avatarId': avatarId},
                            success: function(msg){
                                  upAlert.innerHTML="Avatar "+avatarId+" Alterando avatar, recarregue a página para aplicar a mudança"; 
                            }
                        });
            });


        </script>


            <div id="profile-info" ng-app="myApp" ng-controller="myCtrl">
                <h3 id="alt-dados">Alterar dados</h3>
                <div id="Dname" class="Dinfo"><h4 class="profile-h">Nome:</h4> <p class="inline">{{name}}</p></div>
                <div id="Dnickname" class="Dinfo"><h4 class="profile-h">Apelido:</h4> <p class="inline">{{nick}}</p></div>
                <div id="Demail" class="Dinfo"><h4 class="profile-h">Email:</h4> <p class="inline">{{email}}</p></div>
                <div id="Didade" class="Dinfo"><h4 class="profile-h">Idade:</h4> <p class="inline">{{age}}</p></div>
                <div id="Dbirth" class="Dinfo"><h4 class="profile-h">Data de Nascimento:</h4> <p class="inline">{{birthdate}}</p></div>
                <a><p id="change-pass">Mudar senha</p></a>
            </div>
            <script>
                <?php
                    $name= $userAccount->getName();
                    $nickname= $userAccount->getUsername();
                    $email= $userAccount->getEmail();
                    $birthdate= $userAccount->getBirthdate();
                    $date= date("Y-m-d");
                    $age = date_diff(date_create($birthdate), date_create($date));

                ?>    

                var app = angular.module('myApp', []);
                app.controller('myCtrl', function($scope) {
                    $scope.name= "<?php echo $name; ?>";
                    $scope.nick= "<?php echo $nickname; ?>";
                    $scope.email= "<?php echo $email; ?>";
                    $scope.age= "<?php echo $age->format('%y'); ?>";
                    $scope.birthdate= "<?php echo $birthdate; ?>";
                });
            </script>

        <form id="profile-form" action="_php/profile-action.php">
            <h2 class="profile-h2"><label for="desc">Compartilhe a sua bio</label></h2><textarea id="desc" placeholder="Escreva sobre você"></textarea>
            <button id="submit" name="submit">Enviar</button>
        </form>
        <div id="change-theme">
            <h3>Escolha o tema da sua página:</h3>
                <p class="theme-options">Carro</p><p class="theme-options">Moto</p><p class="theme-options">Caminhão</p>
        </div>
        <h1>Página em Desenvolvimento!</h1>
    </main>
    <script>
        var avatars= document.getElementById('avatars');
    </script>
 <footer id="rodape-profile">
          <a id="sobre" href="index.php">Sobre</a>
          <h3>Copyright 2018 - EuMotorista, All rights reserved.</h3>
          <h3 id ='valpha'>Versão Alpha</h3>
 </footer>

</body> <!-- Included on navin.php-->

</html>