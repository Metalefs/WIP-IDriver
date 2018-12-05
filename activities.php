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
    //LEVELLING UP
                $score = new Score($userAccount->getId());
                $totalScore = $score->getTotalScore(); 
                $level = (ceil($totalScore / 750));

        echo $level." ".$totalScore;
       
        
        

        if($totalScore > 500 * (1/2)){
            $userAccount->levelUp($level+1);
        }
?>

<?php include_once __DIR__.'/'.'./_php/nav-in.php'; ?>
        <div id="ngapp" ng-app="myApp" ng-controller="myCtrl">
            <div id="notice">
                <header id="activity-id">
                        <img id="activity-icon" src="_imagens/<?php if ($userAccount->getTheme() == 1){ echo 'volante'; }else if($userAccount->getTheme() == 2){ echo 'moto'; }else{echo 'AB1'; } ?>.png">
                        <h1>{{nomeTema}}</h1>
                </header>
            </div>
             
            <main id="activities">
               <button id="fale-conosco" style="cursor:pointer; display:block;
                position:relative; float:right; border:0;font-family='Roboto';font-size:10pt;text-align:center;width:auto;margin:10px 20px;font-weight:bold;background:rgb(0, 0, 0);color:white;border-radius:5px;">Fale Conosco - Mande um Feedback sobre a página!</button>
                <section id="top">
                    <aside id="high-score">
                        <div id="accountLevelDiv" name="accountLevelDiv" class="accountLevelDiv"><h1 id="level">{{levelshow}}</h1></div>

                            <h4 id="progress-text" class="progress-text">Progresso para o nível {{level}}:</h4>
                        <meter id="levelProgressBar" name="levelProgressBar" class="levelProgressBar"></meter><h3 id="progressNumber" class="progress-text">{{score}}/{{max}}</h3>


                        <div id='lock1' class='lock'><img id='lock' src='_imagens/lock.png' alt='desbloquear novos modulos'></div>
                    </aside>

                    <div id="activities-container">
                        <?php
                                include_once __DIR__.'/_php/SubjectGetter.php';
                                getAllSubjects();
                            ?>
                    </div>
                </section >
                <section id="side">
                    <aside id="progress-nav">
                        <h2 id="levelh2">Placar</h2>





                    </aside>
                    <a href="exercises.php?subjectId=2"><div id="act2Div"><h3 id="act2">Sessão de Treinamento</h3></div></a>
                </section>
                
            </main>
            <div class="container feedback hide-form" id="form-container">
            <div class="row feedback" style="margin-top: 50px">
                <div class="col-md-6 col-md-offset-3 form-container feedback">
                    <h2>Fale Conosco</h2>
                    <p> Escreva o seu comentário abaixo: </p>
                    <form role="form" method="post" id="reused_form">
                        <div class="row">
                            <div class="col-sm-12 form-group ">
                                <label>Como você classifica o EuMotorista?</label>
                                <p>
                                    <label class="radio-inline">
                                        <input type="radio" name="experience" id="radio_experience" value="bad" >
                                        Ruim 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="experience" id="radio_experience" value="average" >
                                        Médio 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="experience" id="radio_experience" value="good" >
                                        Bom 
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="comments"> Comentário:</label>
                                <textarea class="form-control" type="textarea" name="comments" id="comments" placeholder="Seus comentários" maxlength="6000" rows="7"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name"> Seu Nome:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="email"> Seu Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <button type="submit" class="btn btn-lg btn-warning btn-block" >Postar </button>
                            </div>
                        </div>
                    </form>
                    <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Comentário postado com sucesso!</h3> </div>
                    <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Erro</h3> Ouve um erro ao enviar o comentário </div>
                </div>
            </div>
        </div>
        </div>
        <script type="text/javascript">
            var openIframe=document.getElementById("fale-conosco");
            var hide1 = document.getElementById("corpo");
            var ifrm = document.getElementById("form-container");
            var feedbackIsOpen=false; 
             
            openIframe.addEventListener('click',prepareFrame);
        
            function prepareFrame() {
              if(feedbackIsOpen==false){
                ifrm.setAttribute("class", "container feedback show");
                ifrm.style.width = "640px";
                ifrm.style.height = "480px";
                feedbackIsOpen=true;
              } else {
                ifrm.setAttribute("class", "container feedback hide-form");
                ifrm.style.width = "640px";
                ifrm.style.height = "480px";
                feedbackIsOpen=false; 
              }
            }
        $(function()
        {
        function after_form_submitted(data) 
        {
            if(data.result == 'success')
            {
                $('form#reused_form').hide();
                $('#success_message').show();
                $('#error_message').hide();
            }
            else
            {
                $('#error_message').append('<ul></ul>');
    
                jQuery.each(data.errors,function(key,val)
                {
                    $('#error_message ul').append('<li>'+key+':'+val+'</li>');
                });
                $('#success_message').hide();
                $('#error_message').show();
    
                //reverse the response on the button
                $('button[type="button"]', $form).each(function()
                {
                    $btn = $(this);
                    label = $btn.prop('orig_label');
                    if(label)
                    {
                        $btn.prop('type','submit' ); 
                        $btn.text(label);
                        $btn.prop('orig_label','');
                    }
                });
                
            }//else
        }
    
    	$('#reused_form').submit(function(e)
          {
            e.preventDefault();
    
            $form = $(this);
            //show some response on the button
            $('button[type="submit"]', $form).each(function()
            {
                $btn = $(this);
                $btn.prop('type','button' ); 
                $btn.prop('orig_label',$btn.text());
                $btn.text('Sending ...');
            });
            
    
                        $.ajax({
                    type: "POST",
                    url: 'handler.php',
                    data: $form.serialize(),
                    success: after_form_submitted,
                    dataType: 'json' 
                });        
            
          });	
    });
        </script> 
        <script>
            var scoreAtualVar = <?php echo $totalScore; ?>;
            var maxScoreVar = <?php if($totalScore == 0){echo 250;} else { echo ceil($totalScore / 750)  * 750 ;} ?>;
            var scoreDiff =  maxScoreVar - scoreAtualVar;
            var proxLevelVar = <?php echo (ceil($totalScore / 750)+1); ?>;
            var levelAtualVar = <?php echo (ceil($totalScore / 750)); ?>; 
            var nomeTemaVar = "<?php if ($userAccount->getTheme() == 1) { echo 'Carro'; }  else if($userAccount->getTheme() == 2){ echo 'Moto';} ?>";
            var barValue = 0 ;

            var levelBar= document.getElementById("levelProgressBar");
            
            levelBar.value = scoreAtualVar;
            levelBar.max = maxScoreVar;
            if(levelAtualVar > 1 ){ levelBar.min = maxScoreVar - 750} else { levelBar.min = 0};
            
            var app = angular.module('myApp', []);
            app.controller('myCtrl', function($scope) {
                $scope.score= scoreAtualVar;
                $scope.max= maxScoreVar;   
                $scope.level= proxLevelVar;  
                $scope.levelshow= levelAtualVar;  
                $scope.nomeTema= nomeTemaVar;
            });         
        </script>
     
    <?php  include_once'./_php/footer-in.php'; ?>
</body> <!-- Included on navin.php-->
</html>