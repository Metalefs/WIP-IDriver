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
                $level = 1;

        echo $level." ".$totalScore;

        if($totalScore > 500 * (1/2)){
            $userAccount->levelUp($level+1);
        }
?>

<?php include_once __DIR__.'/'.'./_php/nav-in.php'; ?>
        <div id="ngapp" ng-app="myApp" ng-controller="myCtrl">
            <div id="notice">
                <header id="activity-id">
                        <img id="activity-icon" src="_imagens/<?php if ($userAccount->getTheme() == 1){ echo 'volante'; }else if($userAccount->getTheme() == 2){ echo 'moto'; } ?>.png">
                        <h1>{{nomeTema}}</h1>
                </header>
            </div>
            
            <main id="activities">
                <section id="top">
                    <aside id="high-score">
                        <div id="accountLevelDiv" name="accountLevelDiv" class="accountLevelDiv"><h1 id="level">{{levelshow}}</h1></div>

                            <h4 id="progress-text" class="progress-text">Progresso para o nível {{level}}:</h4><progress id="levelProgressBar" name="levelProgressBar" class="levelProgressBar"></progress><h3 id="progressNumber" class="progress-text">{{score}}/{{max}}</h3>


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
                    <div id="act2Div"><h3 id="act2">Sessão de Treinamento</h3></div>
                </section>
            </main>
        </div>
        <script>
            var scoreAtualVar = <?php echo $totalScore; ?>;
            var maxScoreVar = <?php if($totalScore == 0){echo 250;} else { echo ceil($totalScore / 750)  * 750 ;} ?>;
            var proxLevelVar = <?php echo (ceil($totalScore / 750)+1); ?>;
            var levelAtualVar = <?php echo (ceil($totalScore / 750)); ?>; 
            var nomeTemaVar = "<?php if ($userAccount->getTheme() == 1) { echo 'Carro'; }  else if($userAccount->getTheme() == 2){ echo 'Moto';} ?>";
            
            var levelBar= document.getElementById("levelProgressBar");
            levelBar.value = scoreAtualVar;
            levelBar.max= maxScoreVar;
            if(scoreAtualVar==maxScoreVar){
                levelBar.value = 0;
            }
            
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