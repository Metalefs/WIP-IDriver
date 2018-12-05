<!DOCTYPE html>
<?php
    require_once (__DIR__.'/'.'_php/Admin.php');
    require_once (__DIR__.'/'.'../_php/SuperGlobalChecker.php');
    require_once (__DIR__.'/'.'_php/CreateExerciseData.php');
    if(!isset($_SESSION)){session_start();} 
    $sessionChecker = new SuperGlobalChecker(7);
    $sessionChecker->addObject("adminAccount");
    $existenceTest = $sessionChecker->testExistence();
	if(!$existenceTest){header("Location: index.php?error");}
	else{
		try{$adminAccount = Admin::unsessionate($_SESSION['adminAccount']);}
		catch(Exception $e){header("Location: index.php?error");}
    }
?>
<?php
    require_once __DIR__."/"."_php/nav-admin.php";    
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/development.css">
    <script src="_scripts/advancedtextfield.js"></script>
    <script src="_scripts/Answers.js"></script>
    <script src="_scripts/ExerciseGen.js"></script>
    <script src="../_scripts/jquery.min.js"></script>
    <script src="../_scripts/angular.js"></script>
    <title>Document</title>
    <title>Criar novo módulo</title>
</head>
<body>
    <main class="ex-creation">
    <header>
            <a id="this.previous" href="selecaoDeFerramenta.php"><h4 span style="float: left;">Motor de criação > </h4></a>
            <a id="this-header"><br><br><br><h1 id="header-h1">Criação de Exercicios</h1></a>
    </header>
        <div ng-app="">
            <aside id="demo-section"> 
                
                <div id="exercise-page">   <p id="p-demo" style="text-align:center;">Prévia da criação do exercicio</p>
                    <div id="nav-points">
                        <div id="score2" class="scoreNav">
                            <div id="points-bar" class="greenProg " style="width:0">{{pontos}}</div>
                            </div> 
                            <div id="marks" class="scoreNav">
                                 <div id="mark1" class="marks"></div>
                                 <div id="mark2" class="marks"></div>
                                 <div id="mark3" class="marks"></div>
                            </div> 
                    </div>
                    <div id="description2">{{descricao}}</div>
                    <div id="ex-display2">
                        <div id="question2"></div> <!--CREATE QUESTION ( WITH IMAGES ) -->
                        <section id="answerSection2">
                            <div id="answers2"></div>
                        </section>
                    </div>
                    
                    <div class="hidden-exercise-form"> <!--FEED DIV WITH AJAX-->
                    </div>
                </div>  
                
            </aside>*titulo não aparecerá nos exercicios!
            <div id="demo-img"><img id="demo" src="../_imagens/pag-exercicios.png"></div>
        <form name="questionForm" id="questionForm" class="questionForm">
            
                   <h3 class="guide" id="titleSpan">Titulo:</h3>
                    <input class="title" name="questionTitle" id="questionTitle" type="text" ><br>
                
                    <h3 class="guide" id="titleSpan">Módulo:</h3>
                    <select name="subject" id="subject">
                        <option value="null">SELECIONAR</option>
                        <?php
                            $getSubject = getExerciseSubject();
                            for($i=0;$i<count($getSubject[0]);$i++){
                                printf("<option value=\"".$getSubject[0][$i]."\">".$getSubject[1][$i]."</option>");
                            }
                        ?>
                    </select><br>
                
                    <td class="questionSpans"><h3 class="guide" id="descriptionSpan">Descrição:</h3></td>
                    <td><textarea id="description" class="materialContent" form="questionForm" placeholder="Insira uma descrição" name="description" ng-model="descricao"></textarea></td>
                    
                <tr>
                    <td class="questionSpans"><h3 class="guide" id="correctSpan">Alternativa<br>correta:</h3></td>
                    <td><select name="correctAnswer" id="correctAnswer">
                        <option id="answerCorrectOption0" name="answerCorrectOption0" value="-">-</option>
                    </select></td>
                </tr>
                <tr><br>
                    <td class="questionSpans"><h3 class="guide" id="scoreSpan">Pontuação:</h3></td>
                    <td><select name="score" id="score" ng-model="pontos">
                        <option value="0">0</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                    </select></td>
                </tr>
               
                    <h3 class="guide" id="statementSpan">Enunciado:</h3>
                    <advanced-textfield id="statement" class="materialContent" form="questionForm" name="statement"></advanced-textfield>
                    <button type="button" name="statementAddImage" id="statementAddImage" class="addImage">Adicionar Imagem</button>
                    <button type="button" id="refresh">Atualizar Preview</button><button type="button" id="erase">Limpar Preview</button>
            <table id="alts">
                <tbody id="answers" name="answers">

                </tbody>
            </table>
            <button class="button" type="button" name="addAnswer" id="addAnswer">Adicionar Alternativa</button>
            <button class="button" type="button" name="removeAnswer" id="removeAnswer">Remover Alternativa</button><br/>
            <span id="errors" style="color: red">&nbsp;</span><br/><br/><br/>
            
            <button class="btn" type="button" name="criarExercicio" id="criarExercicio" onclick="sender();">Enviar</button>
        </form>
    </div>
        <script>
            answers = new Answers("answers","answer","answers","questionSpans","Insira uma resposta","materialContent","Adicionar Imagem","addImage","correctAnswer",3,10);
            var addButton = document.getElementById("addAnswer");
            var removeButton = document.getElementById("removeAnswer");
            document.getElementById("statementAddImage").setAttribute("onclick","answers.addImage(document.getElementById(\"statement\").childNodes[0]);");
            addButton.setAttribute("onclick","answers.addAnswer();");
            removeButton.setAttribute("onclick","answers.removeAnswer();");
            var x;
            for (x = 0; x<3 ;x++){
                answers.addAnswer();
            }   
                
            
            var questionArea = document.getElementById("question2");
            var btnAtualizar = document.getElementById("refresh");
            var btnErase = document.getElementById("erase");
            var questionStatement2 = $("#statementContent").html();
            var correctAnswer2 = $("#correctAnswer").val();
            var answerArea = document.getElementById("answers2");
            var i=0,j=1;
            
            btnAtualizar.addEventListener('click',function(){
                alert(questionStatement2);
                alert("atualizando...");
                questionArea.innerHTML="<div id='questionBox'><h1 id='ex-question'>"+questionStatement2+"</h1></div>";
                for(var i=1;$("#answer"+i+"Content").html() != null;i++){
                    answerArea.innerHTML+='<div id="alternatives'+j+'" class="alternatives" name="alt'+j+'">'+"<p id='altNum' class='altNum'>"+j+" - </p>"+($("#answer"+i+"Content").html())+"</div>";
                     j++;
                }
                
                $.ajax({
                    type: 'POST',
                    url: '_php/showDemo.php',
                    data: { 'correctAnswer2': correctAnswer2,
                        'questionStatement2': questionStatement2, },
                    success: function(msg){
                      alert(msg);
                      questionArea.innerHTML="<div id='questionBox'><h1 id='ex-question'>"+msg+"</h1></div>";
                    }
                });
                
            });
            btnErase.addEventListener('click',function(){
                questionArea.innerHTML="";
                answerArea.innerHTML="";
            });
            
            
        </script>
            
        </main>
    
    <?php
    require_once "../_php/footer-in.php";
    ?>
</body>
</html>
<script>
    function sender(){
        var error = false;
        var questionTitle = $("#questionTitle").val();
        var questionSubject = $("#subject").val();
        var questionDescription = $("#description").val();
        var correctAnswer = $("#correctAnswer").val();
        var score = $("#score").val();
        var questionStatement = $("#statementContent").html();
        var questionAnswers = [];
        for(var i=1;$("#answer"+i+"Content").html() != null;i++){
            questionAnswers.push($("#answer"+i+"Content").html());
        }
        //test title
        if(questionTitle.length < 3){
            error=true;
            $("#questionTitle").css("background-color","#ffc1c1");
        }
        else{
            $("#questionTitle").css("background-color","white");
        }
        //Teste subject
        if(isNaN(questionSubject)||parseInt(questionSubject) <= 1){
            error=true;
            $("#subject").css("background-color","#ffc1c1");
        }
        else{
            questionSubject = parseInt(questionSubject);
            $("#subject").css("background-color","white");
        }
        //Test Correct answer
        if(isNaN(correctAnswer) || parseInt(correctAnswer)>questionAnswers.length || parseInt(correctAnswer) <= 0){
            error=true;
            $("#correctAnswer").css("background-color","#ffc1c1");  
        }
        else{
            correctAnswer = parseInt(correctAnswer);
            $("#correctAnswer").css("background-color","white");
        }
        //test score
        if(isNaN(score)||score < 0||score > 50){
            error=true;
            score = paseInt(score);
            $("#score").css("background-color","#ffc1c1");
        }
        else{
            $("#score").css("background-color","white");
        }
        //test statement
        if(questionStatement.length < 5){
            error=true;
            $("#statementContent").css("background-color","#ffc1c1");
        }
        else{
            $("#statementContent").css("background-color","white");
        }
        //test number of answers
        if(questionAnswers.length < 2){
            error=true;
        }
        //test answers
        for(i=0;i<questionAnswers.length;i++){
            if(questionAnswers[i].length<3){
                error=true;
                $("#answer"+(i+1)+"Content").css("background-color","#ffc1c1");
            }
            else{
                $("#answer"+(i+1)+"Content").css("background-color","white");
            }
        }
        //Test if had any error
        if(error==true){
            $("#errors").text("Corrija os campos em vermelho!");
        }
        if(error==false){
            $("#errors").text("");
            $.ajax({
                type: 'POST',
                url: '_php/ExerciseGen.php',
                data: { 
                    'questionTitle': questionTitle, 
                    'questionSubject': questionSubject,
                    'questionDescription': questionDescription,
                    'correctAnswer': correctAnswer,
                    'score': score,
                    'questionStatement': questionStatement,
                    'questionAnswers': questionAnswers
                },
                success: function(msg){
                    alert(msg);
                    location.reload();
                }
            });
        }
    }
</script>
