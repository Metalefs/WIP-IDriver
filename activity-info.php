<?php
    if(!isset($_SESSION)){session_start();} 
	require_once (__DIR__.'../'.'_php/Subject.php');
	require_once (__DIR__.'../'.'_php/Account.php');
	require_once (__DIR__.'../'.'_php/SuperGlobalChecker.php');
    $sessionChecker = new SuperGlobalChecker(7);
	$sessionChecker->addObject("userAccount");
	$existenceTest = $sessionChecker->testExistence();
	if(!$existenceTest){header("Location: index.php?error");}
	else{
		try{
            $userAccount = Account::unsessionate($_SESSION['userAccount']);
            if($userAccount->getTheme() == null){header("Location: ../cursos.php");}
        }
        catch(Exception $e){header("Location: index.php?error");}
	}
    require_once (__DIR__.'/'.'/config/dbConfig.php');
    if(!isset($_SESSION)){session_start();} 
    require_once (__DIR__.'/'.'/_php/Account.php');
    require_once (__DIR__.'/'.'/_php/SuperGlobalChecker.php');
 
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
    
    <link rel="stylesheet" type="text/css" href="./css/subject.css">
    <link rel="stylesheet" type="text/css" href="./css/nav-in.css">
    <style>
        
    </style>
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

    <?php $subjectId = $_GET['subjectId']; 
        $_SESSION['subjectId'] = $subjectId;
        $sinalizacao = new Subject($subjectId); 
        $totalExercises = $sinalizacao->getTotalExercises();
    ?>
    
<main id="subject-in">
    
	<div id="subject-info" class="sub-in">
        <div id="introduction"><a href="exercises.php?subjectId=2"><button id="start">Começar!</button></a>
            <h1 id="sub-name"><?php echo $sinalizacao->getSubjectName(); ?> -<?php echo $sinalizacao->getTotalExercises(); ?></h1>
            
            <h2 id="sub-description"><?php echo $sinalizacao->getDescription(); ?></h2>
        </div>
        <p id="sub-introduction"><?php echo $sinalizacao->getIntroduction(); ?></p>
        <img src="_imagens/placasAdvertencia.png">
        <img src="_imagens/placasRegulamentacao.png">
	</div>
	<div id="exercise-box" class="sub-in">
		<div id="title"></div>
		<a href="exercises.php?subjectId=2"><div id="description"></div></a>
	</div>

</main>

<script>
            
                var exercisePage= document.getElementById("subject-in");
                var description = document.getElementById("description");
               	var exercises = document.getElementById("exercise-box");
               	var title = document.getElementById("description");
                var btnComecar = document.getElementById('start');
            
            for (i = 1 ; i < <?php echo $totalExercises ?> ; i++){
                getExercise(i);
            }
   // getExercise(i);
                function getExercise(exerciseId){
                    var request = new XMLHttpRequest();
                    
                        request.open('GET','./content/2/exercise/<?php echo $subjectId; ?>_'+exerciseId+'/<?php echo $subjectId; ?>_'+exerciseId+'.json',true);
                        request.onload = function() {
                            if (this.readyState == 4 && this.status == 200) {            
                            var exercises = JSON.parse(request.responseText);
                            console.log(exercises[0]);
                            addExercise(exercises); 
                            } else {
                                console.log("Connected to database, but returned an error");
                            }
                        };
                            request.send();  
                    
                }
                        btnComecar.addEventListener('click',function(){
                          //  window.location = 'exercises.php';
                            console.log("clicou");
                        });
                
            
                function addExercise(exercise) {
                    var i, alternatives="";
                    var j=1;
                    console.log("addExercise begin");
                    console.log(exercise.length);
                    
                           var title = '<a href="exercises.php"><h4 id="ex-title">'+exercise.title+"</h4></a>";
                           
                           var descricao= "<h3 id='ex-desc'>"+exercise.description+"</h3>";
                           
                           var exp= exercise.exp; 
                            
                            title.innerHTML+=title; 
                            description.innerHTML+=descricao; 
                            description.innerHTML+=exp; 
                            
                    
                            console.log(exercise[0]);
                            console.log("addChar function end");
                }
</script>
<?php
    
    include_once'./_php/footer-in.php';

?>
    </body>
</html>