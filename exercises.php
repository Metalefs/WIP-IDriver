<html lang="br">
<?php
    if(!isset($_SESSION)){session_start();} 
	require_once (__DIR__.'/'.'_php/Subject.php');
	require_once (__DIR__.'/'.'_php/Account.php');
    require_once (__DIR__.'/'.'_php/Exercise.php');
	require_once (__DIR__.'/'.'_php/SuperGlobalChecker.php');

    $sessionChecker = new SuperGlobalChecker(7);
	$sessionChecker->addObject("userAccount");
	$existenceTest = $sessionChecker->testExistence();
	if(!$existenceTest){header("Location: index.php?error");}
	else{
		try{
            $userAccount = Account::unsessionate($_SESSION['userAccount']);
            if($userAccount->getTheme() == null){header("Location: /cursos.php");}
        }
        catch(Exception $e){header("Location: index.php?error");}
	}
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
        <audio class="feedback-audio" id="correct-audio" src="./_media/correct.wav" type="audio/wav">Your browser does not support the audio tag</audio>
        <audio class="feedback-audio" id="error-audio" src="./_media/error.mp3" type="audio/wav">Your browser does not support the audio tag</audio>   
          <div id="marks" class="scoreNav">
             <div id="mark1" class="marks"></div>
             <div id="mark2" class="marks"></div>
             <div id="mark3" class="marks"></div>
          </div> 
         <div id="loading" class="loading"></div>
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
                    <div class="hidden-exercise-form"> <!--FEED DIV WITH AJAX--><p style="font-size:10px">-Página em desenvolvimento! (se o exercicio não iniciar instantaneamente, aguarde por favor)</p>
                    </div>

                <!-- CREATE A CHECKBOX FOR EACH ALTERNATIVE-->
    <?php 
        $subjectId = $_GET['subjectId'];                        //getting echoed get value for the selected subject from ativities.php page
        $_SESSION['subjectId'] = $subjectId;                    //setting  the echoed get value for session 
        $ex="";                                                 //setting the exercise number to null
        $subject = new Subject($subjectId);                     //getting Subject data from the database, including the total number of exercises
        $totalExercises = $subject->getTotalExercises();        //setting the amount of exercises to be played before ending the session
        
        $exercises = new Exercise($subjectId);                  //getting Exercise data from the database
        $exercisePaths = $exercises->getPaths();
        
        
    ?>
        
            
         

        <script>
            var totalExercises = <?php echo $totalExercises ?>;
            var ex = 1;
            var exp=0;
            var lastExp=0;
            var totalExp=0;
            var m1Red=false,m2Red=false,m3Red=false;
            var errors=0;
            var acertos=0;
            var exercisePaths = <?php echo json_encode($exercisePaths) ?>;
        
            console.log(exercisePaths);
            
            var btnExercise = document.getElementById("btn-exercise");
            
                
            function randomEx(min, max) { //FUNCTION TO RETURN RANDOM NUMBER IN A RANGE
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
            
            firstExercise = randomEx(0, (exercisePaths.length)-1);
            
            function playExercise(){// FUNCTION TO PLAY A SELECTED EXERCISE
                var selec = document.getElementById("insert-exercise").value;
                loadExercise(selec);
            };
            
            var altBox = document.getElementsByClassName('alternatives');
            loadExercise(firstExercise);
            var btn= document.getElementById("btn");
            var exercisePage= document.getElementById("exercise-page");
            var question = document.getElementById("question"); 
            var description = document.getElementById("description");
            var exDisplay = document.getElementById("ex-display");
            
            var exit = document.getElementById('exit');
            var mark1 = document.getElementById('mark1');
            var mark2 = document.getElementById('mark2');
            var mark3 = document.getElementById('mark3');
            var loading = document.getElementById("loading");
            
                    mark1.style.backgroundColor = "yellow";
                
            
            exit.addEventListener('click',function(){ // FUNCTION TO EXIT SESSION
                window.location = 'index.php';
            });
            var i,title,disciplina,descricao,enunciado,answersvar,resposta,alternatives=""; //initializing all exercise variables TEST -- DEFAULT == FIRST LINE OF addExercise() FUNCTION    
            
            var isSelected=false,isWrong=false;// CHECKS IF THE ALTERNATIVE HAS BEEN CLICKED    
            
            
            function loadExercise(exerciseId){//loads exercises and adds them to the page
                resposta = "";
                var request= new XMLHttpRequest();  
                while(exercisePaths[exerciseId]=="./content/default.json"){
                    exerciseId = randomEx(0,totalExercises);;
                }
                request.open('GET',''+exercisePaths[exerciseId]+'',true);
                request.onload = function() {
                   if (this.readyState == 4 && this.status == 200) {            
                       exercises = JSON.parse(request.responseText);
                    //   console.log(exercises[0]);
                       resposta = "";
                     //  alert("Loading Exercise: "+resposta);
                       addExercise(exercises); 
                   } else {
                          console.log("Connected to database, but returned an error");
                   }
                };
                request.send();  
            }
            
            loading.className="loading false";
            function addExercise(exercise) {//inserts the exercise date into the page 
                    while (answers.hasChildNodes()) {   
                           answers.removeChild(answers.firstChild);
                    } 
                    var j=1;
                    alternatives="";
                    isSelected=false;isWrong=false;
                    //console.log("addExercise begin");
                    console.log(exercise.length);
                    var random = Math.floor(Math.random() * (1 - 0 + 1)) + 0;
                           var title = "<h4 id='ex-title'>"+exercise.title+"</h4>";
                           var disciplina= "<h4 id='ex-subject'>"+exercise.subjectId+"</h4>"; 
                           var descricao= "<h3 id='ex-desc'>"+exercise.description+"</h3>";
                           var enunciado= "<div id='questionBox'><h1 id='ex-question'>"+exercise.questionStatement+"</h1></div>";
                           
                           for (i in exercise.alternatives){
                                
                                alternatives+='<div id="alternatives'+j+'" class="alternatives" name="alt'+j+'">'+exercise.alternatives[i]+"</div>";//adding each alternative 
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
                       //     console.log(exercise[0]);
                       //     console.log("addChar function end");

                          
                }
                
                //CHECANDO SELEÇÃO
                
                
                
                     answers.addEventListener('click',function(event){  
                        
                        if (ex-1 >= 13){ //para testes - padrão (sem -25)
                                while (answers.hasChildNodes()) {   
                                    answers.removeChild(answers.firstChild);
                                } 
                                alert("Desafio completo!");
                                    addScore();
                                    totalExp += exp;
                                    description.innerHTML="Desafio Completo!"; 
                                    //description.innerHTML+=disciplina; 
                                    msgEnd="<div id='finishBox'><h3 id='pontuacao'>Pontuação recebida: "+totalExp+" pontos</h3><h3 id='errors'>Erros: "+errors+"</h3><h3 id='acertos'>Acertos: "+acertos+"</h3></div>";
                                    
                                    exercisePage.style.marginTop = "20%";
                                    exercisePage.style.padding = "105px";
                                    
                                    exDisplay.innerHTML="<button id='continuar' class='finishBtn' onclick='continuar()'>Repetir Desafio</button><button id='sair' class='finishBtn' onclick='sair()'>Ver material de estudo ou tentar outra matéria</button>";    
                                    exercisePage.innerHTML+=msgEnd; 
                         
                        }

                             //resposta = "alternatives"+exercises.answer;     
                            // alert("seleção: "+event.target.id);
                        if(event.target.id!="answers"){
                            if(event.target.id==resposta){ 
                                showLoading();
                                if (isSelected == false && isWrong==false){
                                    acertos++;
                                    $( '#'+resposta ).append( "<img class='feedback' id='correct' src='./_imagens/correct.png'>" );
                                    document.getElementById(resposta).style.backgroundColor="rgba(20,255,20,.85)"; 
                                    document.getElementById("correct-audio").play();
                                    totalExp += exp;
                                    move();  
                                   // alert("ACERTO resposta: "+resposta);
                                   
                                    
                                    if(m1Red==false){
                                        mark1.style.backgroundColor = "yellow"; 
                                        mark1.style.border="0"; 
                                        mark3.style.backgroundColor = "white"; 
                                    } else {
                                        if(m2Red==false){
                                             mark2.style.backgroundColor = "yellow"; 
                                             mark2.style.border="0"; 
                                             mark3.style.backgroundColor = "white"; 
                                        } else {
                                             mark3.style.backgroundColor = "yellow"; 
                                             mark3.style.border="0"; 
                                        }
                                    }
                                      setTimeout(nextExercise, 1000);
                                      
                                      isSelected = true;
                                }     
                            } else {
                                showLoading();
                                if(isSelected==false && isWrong==false){
                                    errors++;
                                 //   alert("ERRO resposta: "+resposta);
                                    $( '#'+event.target.id ).append( "<img class='feedback' id='wrong' src='./_imagens/wrong.png'>" );
                                    document.getElementById(event.target.id).style.backgroundColor="rgba(255,20,20,.85)";
                                    document.getElementById("error-audio").play();
                                    if(errors == 3){
                                        mark1.style.backgroundColor = "red";
                                        mark2.style.backgroundColor = "red";
                                        mark3.style.backgroundColor = "red";
                                        m3Red = true;
                                    } 
                                    if(errors == 2){
                                        mark1.style.backgroundColor = "red";
                                        mark2.style.backgroundColor = "red";
                                        m2Red = true;
                                        mark3.style.backgroundColor = "yellow";
                                    }
                                    if(errors == 1) {
                                        mark1.style.backgroundColor = "red";
                                        m1Red = true;
                                        mark3.style.backgroundColor = "white";
                                        mark2.style.backgroundColor = "yellow";
                                        }
                                    
                                     setTimeout(nextExercise, 1000);
                                    
                                isWrong=true;
                                    desafioFalhou();
                                } 
                            }
                                 
                                 desafioFalhou(); //checa se as três multas foram aplicadas, se sim, termina o desafio 
                        }
                    }); 
                    
                var subjectId = <?php echo $subjectId; ?>;
                var nextEx=1;
   
                function nextExercise(){ // AO SELECIONAR UMA ALTERNATIVA
                ex++;
            
                    var nextRandomEx = randomEx(0, (exercisePaths.length)-1);

                    //alert(nextRandomEx);
                    //  alert("-exercicio: "+(ex));
                    if (ex-1 <= (exercisePaths.length)-1){ //faz até a quantidade total de exercicios no banco de dados (TESTE) 
                        
                        loadExercise(nextRandomEx);
                        showLoading();
                    }   
                    // alerta o num do exercicio (teste)
                    <?php  $ex++; $_SESSION['lastExercise'] = $ex;  ?> //guardando o ultimo exercicio jogado na sessão
                }
                var isLoading=false;
                function showLoading(){
                    if (isLoading==false){
                        loading.className="loading true";
                        isLoading=true;
                    } else {
                        loading.className="loading false";
                        isLoading=false;
                    }
                }
                
                function continuar(){ // AO CLICAR EM REPETIR DESAFIO E TENTAR NOVAMENTE
                    nextEx =0;
                    exp = 0;
                    lastExp = 0;
                    m1Red=false;
                    m2Red=false;
                    m3Red=false;
                    errors=0;
                    location.reload();
                }    
      
                function sair(){ // AO CLICAR EM SAIR
                    window.location = "activities.php";
                }
            
                function move() { // AO ACERTAR UMA QUESTÃO
                    
                    var elem = document.getElementById("points-bar");   
                    var width  = exp;
                    var id = setInterval(frame, 20);
                    function frame() {
                        if (width >=totalExp) {
                            clearInterval(id);
                        } 
                        else {
                            width++; 
                            elem.style.width = width + '%'; 
                            elem.innerHTML = width *1  + ' Pontos';
                        }
                    }
                   
                }
            
                function desafioFalhou(){
                   msgEnd="<div id='finishBox'><h3 id='pontuacao'>Pontuação perdida: "+totalExp+" pontos</h3><h3 id='errors'>Erros: "+errors+"</h3><h3 id='acertos'>Acertos: "+acertos+"</h3></div>";
                    
                    if(errors>=3 && m1Red == true && m2Red == true && m2Red == true){
                        alert("Muitas penalizações! Desafio falhou");
                        description.innerHTML="Muitas penalizações! o desafio falhou"; 
                        //description.innerHTML+=disciplina; 
                        question.innerHTML=""; 
                        exercisePage.style.marginTop = "5%";
                        exercisePage.style.padding = "15px";
                        answers = document.getElementById("answers");
                        exDisplay.innerHTML="<button id='continuar' class='finishBtn wrong' onclick='continuar()'>Repetir Desafio</button><button id='sair' class='finishBtn wrong' onclick='sair()'>Ver material de estudo ou tentar outra matéria</button>";    
                        exDisplay.innerHTML+=msgEnd;
                    }
                }
                
                function addScore(){
                     $.ajax({
                        type:'post',
                        url:'addScore.php',
                        data:{'score': totalExp,
                              'subjectId': subjectId},
                        success: function(msg){
                            //alert("pontuando "+totalExp+' '+subjectId);   
                        }
                    });
                }
               
        </script>
        
    </main>
</div> 
    </body>
    <footer>
    </footer>
</html>
