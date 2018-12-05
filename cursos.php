<?php
include_once (__DIR__.'/'.'./_php/nav-cursos.php');
    if(!isset($_SESSION)){session_start();} 
	require_once (__DIR__.'/'.'_php/Account.php');
	require_once (__DIR__.'/'.'_php/SuperGlobalChecker.php');
	$sessionChecker = new SuperGlobalChecker(7);
	$sessionChecker->addObject("userAccount");
	$existenceTest = $sessionChecker->testExistence();
	if(!$existenceTest){header("Location: index.php?error");
                       }
	else{
		try{
			$userAccount = Account::unsessionate($_SESSION['userAccount']);
			if($userAccount->getTheme() != null){
				header("Location: activities.php");
			}
		}
		catch(Exception $e){//header("Location: index.php?error");
        }
	}
    $userAccount = Account::unsessionate($_SESSION['userAccount']);
    if($userAccount->getTheme() != null){
				header("Location: activities.php");
    }
    $value=0;
?>

<header id="selecione" class="inf-box">
	<h2>Selecione seu interesse</h2>
    <p span style="color:gray; display:inline-block;">*apenas mudanças cosmeticas serão aplicadas.</p>
</header>
	<main id="cursos">

	    <div id="c1" class="curso-container">
	    	<h1 class="box-name">Carro (B)</h1>
	    </div>
	    <div id="c2" class="curso-container">
	    	<h1 class="box-name">Moto (A)</h1>
	    </div>  
	    
	    <form id="check-box" method="post">
	    	<input type="checkbox" id="checkcarro" name="carro" value="Carro">
	    	<input type="checkbox" id="checkmoto" name="moto" value="Moto">
  			<input type="submit" id="continuar" name="continuar" value="Continuar">
	    </form><br>
		<!--/*<?php
			if(isset($_POST['continuar'])){
				$value="";
				if(isset($_POST['carro'])){
					$value += 1;
				}
				if(isset($_POST['moto'])){
					$value += 2;
				}
				if($value !=0){
					try{
						$userAccount->updateTheme($value);
						$_SESSION['userAccount']=$userAccount->sessionate();
						header("Location: activities.php");
					}
					catch(Exception $e){
						
					}
				}
			}
		?>*/-->
	    <section id="message-curso">
	    	<h3>Escolha a modalidade que deseja estudar, você pode fazer várias ao mesmo tempo!</h3>
	    </section>

	     <script type="text/javascript">
	    	var carro= document.getElementById("c1");
	    	var moto= document.getElementById("c2");
	    	var checkcarro = document.getElementById("checkcarro");
	    	var checkmoto = document.getElementById("checkmoto");
	    	var isSetCarro = false;
	    	var isSetMoto = false;
            var continuar = document.getElementById("continuar");
            var select2 = <?php echo $value; ?>;
            
            if (select2 != 0){
                location.reload();
            }
                
             
             continuar.addEventListener('click',function(){
                location.reload(); 
             });
             
            //checa se os campos de curso foram clicados
	    	carro.addEventListener("click", function(){
	    		if(!isSetCarro){ // = class ='.checked'
	    			console.log('click');
	    			checkcarro.checked = true;
	    			isSetCarro = true;
	    			carro.style.backgroundColor = "orange";
	    			carro.style.height = "200px";
                    carro.innerHTML = "<h1 class='box-name'>Carro (B) <br> Selecionado</h1>";
	    		} else { // class ='.curso-container';
	    			checkcarro.checked = false;
	    			isSetCarro = false;
                    carro.style.height = "100px";
	    			carro.style.backgroundColor = "white";
                    carro.innerHTML= "<h1 class='box-name'>Carro (B) </h1>";
	    		}
	    	})
	    	moto.addEventListener("click", function(){
	    		if (!isSetMoto){ // = class ='.checked'
	    			console.log('click');
	    			checkmoto.checked = true;
	    			isSetMoto = true;
	    			moto.style.backgroundColor = "orange";
	    			moto.style.height = "200px";
                    moto.innerHTML = "<h1 class='box-name'>Moto (A) <br> Selecionado</h1>";
   					
	    		} else {// class ='.curso-container';
	    			checkmoto.checked = false;
	    			isSetMoto = false;
                    moto.style.height = "100px";
	    			moto.style.backgroundColor = "white";
	    			moto.innerHTML = "<h1 class='box-name'>Moto (A)</h1>";
	    		}
	    	})


	    </script>


	</main>
 <footer id="rodape">
          <a id="sobre" href="index.php">Sobre</a>
          <h3>Copyright 2018 - EuMotorista, All rights reserved.</h3>
          <h3 id ='valpha'>Versão Alpha</h3>
 </footer>
</body>
</html>