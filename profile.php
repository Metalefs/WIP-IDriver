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

<?php include_once __DIR__.'/'.'./_php/nav-in.php'; ?>

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
    
</main>
<script>
var avatars= document.getElementById('avatars');
    
    
</script>


<?php
    
    include_once'./_php/footer-in.php';

?>
</body> <!-- Included on navin.php-->
</html>