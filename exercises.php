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
<html lang="br">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Capacitação de motoristas de forma gameficada">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Direção,Habilitacao,CNH,Direcao,Habilitação,Auto-Escola">
    <meta name="author" content="Faciweb">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eumotorista: Desafio!</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/tela1.css">
    <link rel="stylesheet" type="text/css" href="./css/exercises.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="./_scripts/jquery.min.js"></script>
    <script src="./_scripts/jquery.min.js"></script>
</head>
<body id="exercise-body">
    <nav id="exercise-nav">
            <div id="icondiv">
                <img id="tempicon" src="_imagens/wheel.png" onClick="./index.html"><a id="title" href="./index.php">EuMotorista</a>   
            </div>
    </nav><!--CREATE TITLE, SUBJECT AND ALERT MESSAGES -->
<div id="ex-padding">
    <main id="exercise-page">
        <div id="nav-points">
        
          <div id="score" class="scoreNav" >
              <div id="points-bar" class="greenProg " style="width:0">0 </div>
          </div> 

          <div id="marks" class="scoreNav">
             <div id="mark1" class="marks"></div>
             <div id="mark2" class="marks"></div>
             <div id="mark3" class="marks"></div>
          </div> 

        </div>
        <div id="description"></div>
            <div id="ex-display">
                <div id="question"></div> <!--CREATE QUESTION ( WITH IMAGES ) -->
                <section id="answerSection">
                    <div id="answers"></div>
                </section>
            </div>
                    <button id="exit" class="">Sair</button>
                    <input id="insert-exercise" type="number" min="1" placeholder="selecione o exercicio(para teste)">
                    <button id="btn-exercise" onclick="playExercise()" type="submit">Go</button>
                    <div class="hidden-exercise-form"> <!--FEED DIV WITH AJAX-->
                    </div>

                <!-- CREATE A CHECKBOX FOR EACH ALTERNATIVE-->
    <?php $subjectId = $_GET['subjectId']; 
        $_SESSION['subjectId'] = $subjectId;
        $ex="";
        $subject = new Subject($subjectId); 
        $totalExercises = $subject->getTotalExercises();
    ?>
                

        <script>
            var ex = 1;
            var exp=0;
            var lastExp=0;
            var totalExp=0;
            var m1Red,m2Red,m3Red=false;
            var errors=0;
            var acertos=0;
            
            
            var btnExercise = document.getElementById("btn-exercise");
            
            function playExercise(){
                var selec = document.getElementById("insert-exercise").value;
                loadExercise(selec);
            };
            
            var altBox = document.getElementsByClassName('alternatives');
            loadExercise(<?php if($ex>0){echo $_SESSION['lastExercise']; } else { echo 1; } ?>);
                var btn= document.getElementById("btn");
                var exercisePage= document.getElementById("exercise-page");
                var question = document.getElementById("question"); 
                var description = document.getElementById("description");
                var exDisplay = document.getElementById("ex-display");
            
                var exit = document.getElementById('exit');
                var mark1 = document.getElementById('mark1');
                var mark2 = document.getElementById('mark2');
                var mark3 = document.getElementById('mark3');
                var exercises=""; //TEST
            
                exit.addEventListener('click',function(){
                    window.location = 'index.php';
                });

                function loadExercise(exerciseId){//loads exercises and adds them to the page
                    var request= new XMLHttpRequest();
                    request.open('GET','./content/2/exercise/<?php echo $subjectId; ?>_'+exerciseId+'/<?php echo $subjectId; ?>_'+exerciseId+'.json',true);
                    request.onload = function() {
                        if (this.readyState == 4 && this.status == 200) {            
                            exercises = JSON.parse(request.responseText);
                            console.log(exercises[0]);
                            addExercise(exercises); 
                        } else {
                            console.log("Connected to database, but returned an error");
                        }
                    };
                        request.send();  
                }
                while (answers.hasChildNodes()) {   
                        answers.removeChild(answers.firstChild);
                    }
              
                function addExercise(exercise) {//inserts the exercise date into the page
                    
                    var i,title,disciplina,descricao,enunciado,answers,resposta,alternatives="";//initializing all exercise variables
                    var j=1;
                    console.log("addExercise begin");
                    console.log(exercise.length);
                    var random = Math.floor(Math.random() * (1 - 0 + 1)) + 0;
                           var title = "<h4 id='ex-title'>"+exercise.title+"</h4>";
                           var disciplina= "<h4 id='ex-subject'>"+exercise.subjectId+"</h4>"; 
                           var descricao= "<h3 id='ex-desc'>"+exercise.description+"</h3>";
                           var enunciado= "<div id='questionBox'><h1 id='ex-question'>"+exercise.questionStatement+"</h1></div>";
                           
                           for (i in exercise.alternatives){
                                
                                alternatives+='<div id="alternatives'+j+'" class="alternatives" name="alt'+j+'">'+"<p id='altNum' class='altNum'>"+j+" - </p>"+exercise.alternatives[i]+"</div>";//adding each alternative 
                                j++;
                           }
                          //  alert("exp do exercicio: "+exercise.exp);
                            exp = parseInt(exercise.exp); 
                            
                            
                    
                            description.innerHTML=title; 
                            //description.innerHTML+=disciplina; 
                            description.innerHTML=descricao; 
                            question.innerHTML=enunciado; 
                            resposta = "alternatives"+exercise.answer;
                            answers = document.getElementById("answers");
                    
                           // alert("resposta: "+resposta);
                    
                            answers.innerHTML=alternatives;              
                            console.log(exercise[0]);
                            console.log("addChar function end");
                           
                        
                }

                 answers.addEventListener('click',function(event){  
                     ex++; 
                            if (ex >= <?php echo $totalExercises ?>){
                                while (answers.hasChildNodes()) {   
                                    answers.removeChild(answers.firstChild);
                                } 
                                alert("Desafio completo!");
                                    //window.location = "activities.php";
                                    description.innerHTML="Desafio Completo!"; 
                                    //description.innerHTML+=disciplina; 
                                    msgEnd="<div id='questionBox'><h3 id='pontuacao'>Pontuação recebida: "+totalExp+" pontos</h3><h3 id='errors'>Erros: "+errors+"</h3><h3 id='acertos'>Acertos: "+acertos+"</h3></div>";
                                    
                                    exercisePage.style.marginTop = "20%";
                                    exercisePage.style.padding = "105px";
                                    
                                    exDisplay.innerHTML="<button id='continuar' class='finish' onclick='continuar()'>Repetir Desafio</button><button id='sair' class='finish' onclick='sair()'>Ver material de estudo ou tentar outra matéria</button>";    
                                    exercisePage.innerHTML+=msgEnd; 
                            }
                                 
                                 
                        var resposta = "alternatives"+exercises.answer;     
                           //    alert("seleção: "+event.target.id);
                            
                        if(event.target.id==resposta){ 
                            acertos++;
                            totalExp += exp;
                            move();  
                           // alert("resposta: "+resposta);
                            alert("Resposta correta!");
                            while (answers.hasChildNodes()) {   
                                answers.removeChild(answers.firstChild);
                            }
                                mark1.style.backgroundColor = "yellow"; 
                                mark1.style.border="0"; 
                                
                            
                            }else{
                                errors++;
                                //alert("resposta: "+resposta);
                                alert("Resposta Incorreta!");
                                
                                if(errors == 3){
                                    mark3.style.backgroundColor = "red";
                                    m3Red = true;
                                } 
                                if(errors == 2){
                                    mark2.style.backgroundColor = "red";
                                    m2Red = true;
                                    mark3.style.backgroundColor = "yellow";
                                }
                                if(errors == 1){
                                    mark1.style.backgroundColor = "red";
                                    m1Red = true;
                                    mark2.style.backgroundColor = "yellow";
                                } 
                                 while (answers.hasChildNodes()) {   
                                    answers.removeChild(answers.firstChild);
                                    setTimeout(loadExercise(ex),500)
                                 } 
                                if(errors>=3 && m1Red == true && m2Red == true && m2Red == true){
                                    alert("Muitas penalizações! Desafio falhou");
                                    //window.location = "activities.php";
                                    description.innerHTML="Muitas penalizações! o desafio falhou"; 
                                    //description.innerHTML+=disciplina; 
                                    question.innerHTML=""; 
                                    exercisePage.style.marginTop = "20%";
                                    exercisePage.style.padding = "105px";
                                    answers = document.getElementById("answers");
                                    exDisplay.innerHTML="<button id='continuar' class='options' onclick='continuar()'>Tentar novamente</button><button id='sair' class='options' onclick='sair()'>Ver material de estudo ou tentar outra matéria</button>";              
                 
                                }       
                         }           
                });
                var nextEx=1;
                function continuar(){
                    nextEx =0;
                    exp = 0;
                    lastExp = 0;
                    m1Red=false;
                    m2Red=false;
                    m3Red=false;
                    errors=0;
                    location.reload();
                }    
                function sair(){
                    window.location = "activities.php";
                }
            
            
                var subjectId = <?php echo $subjectId; ?>;
            
                function move() { 

                    var elem = document.getElementById("points-bar");   
                    var width  = exp;
                    var id = setInterval(frame, 20);
                    function frame() {
                    if (width >=totalExp) {
                        clearInterval(id);
                    } else {
                        width++; 
                        elem.style.width = width + '%'; 
                        elem.innerHTML = width *1  + ' Pontos';
                    }
                    }
                    
                    if (ex <= <?php echo $totalExercises ?>){ //faz até a quantidade total de exercicios no banco de dados (TESTE)
                        setTimeout(loadExercise(ex),500);
                    }else{
                        
                    }
                    alert("-exercicio: "+(ex)); // alerta o num do exercicio (teste)
            
                    $.ajax({
                        type:'post',
                        url:'addScore.php',
                        data:{'score': totalExp,
                              'subjectId': subjectId},
                        success: function(msg){
                            alert("pontuando "+totalExp+' '+subjectId);   
                        }
                    });
            
                    <?php 
                        $ex++; 
                        $_SESSION['lastExercise'] = $ex;
                     
                    ?> //guardando o ultimo exercicio jogado na sessão
                }
                   
    
        </script>
        
    </main>
</div> 
    </body>
    <footer>
    </footer>
</html>
