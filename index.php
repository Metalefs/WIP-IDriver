<!DOCTYPE html>
<html lang="br">
<?php
    if(!isset($_SESSION)){session_start();} 
    require_once (__DIR__.'/'.'_php/SuperGlobalChecker.php');
    $sessionChecker = new SuperGlobalChecker(7);
    $sessionChecker->addObject("userAccount");
    $existenceTest = $sessionChecker->testExistence();
    if($existenceTest){
        header("Location: cursos.php");   
    }
    
?>
<head>
    <meta charset="utf-8">
    <meta name="description" content="Capacitação de motoristas de forma gameficada">
    <meta name="keywords" content="Direção,Habilitacao,CNH,Direcao,Habilitação,Auto-Escola">
    <meta name="author" content="Faciweb">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eumotorista: Aprenda a dirigir sem esforços!</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/tela1.css">
    <link rel="stylesheet" type="text/css" href="./css/signup.css">
    <script src="./_scripts/jquery.min.js"></script>
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
            <img id="tempicon" src="./_imagens/wheel.png">
            <a id="title" href="index.php">EuMotorista</a>
            <p class="header-button animate-pop-in"><a id="login-href" class="header-button button animate-pop-in" href="#dir">Login</a></p>
            <p class="header-button animate-pop-in"><a id="scroll" class="button" onclick="signup()">Comece hoje</a></p>
        </nav>     
            <main id="top">
              <section class="header-content">
                    <figure id=video>
                        <iframe class="header-file" id="video2" width="560" height="315" src="https://www.youtube.com/embed/zPd5g6X34YI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                    </figure>
                    <div class="direito">
                            <h1 class="">Dê um kickstart no seu sonho de dirigir!</h1>
                            <h3 id="dir" class="">O EuMotorista é a melhor plataforma de aprendizado e preparação para testes de direção, com sua didática divertida e incentivos eficientes para estimular o aprendizado de forma inconsciente. Entre agora ou crie o seu perfil para ter acesso a um acervo crescente de atividades dinâmicas com pontuação e correção instantânea, acessar materiais de estudo originais criados por profissionais, assistir a video-aulas da comunidade interna e seu conteúdo audio-visual, e interagir com outros aprendizes nessa plataforma competitiva.</h3></div>
                       <form id="login" action="./_php/loginaction.php" method="post">
                        <h2><label id="label-login" for="email-top">Entre com o seu perfil</label></h2><input name="usernameEmail" id="email-top" class="login" type="text" placeholder="Email ou Apelido">
                        <input name="senha" id="pass-top" class="login" type="password" placeholder="Senha de acesso">
                        <img id="eye2" src="./_imagens/eye-hidden.png"/>
                        <p id="forgot">Esqueci a senha</p>
                        <input type="submit" name="enviar" class="login" id="log" value="Login">
                        
                               <?php $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                                if($host == 'eumotorista.portifoliotgm.esy.es/index.php?error') {
                                    echo (' <div id="alert-login"><div id="alert-login"><h3 id=alert-login-text>Email ou senha errados</h3><div></div>');
                                }
                                ?>
                        
                  </form> 
              </section>     
                 
              <section id="demo">
                  
                  
                <div id="boxes">
                    <div class="inf bot1" ><h2 class="header-title animate-pop-in ">Ganhe Pontos!</h2>
                    <p class="header-subtitle animate-pop-in ">Seu aprendizado fica muito mais interessante <span style="font-style:oblique;">(e até mesmo viciante)</span> quando existem desafios e recompensas em jogo. No EuMotorista, você recebe pontos e desbloqueia novos conteúdos com o seu avanço na matéria, e pode se comparar com seus amigos. Teste-se e aprimore-se com seus erros e desbrave o mundo da direção conosco!</p>
                    </div>
                    <div class="inf bot2"><h2 class="header-title animate-pop-in ">Acervo de Leitura e Interação com outros alunos</h2>
                    <p class="header-subtitle animate-pop-in">Sabemos que a leitura é vital para o sucesso em qualquer área, e que geralmente deixamos de fazer por falta de organização. Por isso, fazemos questão de disponibilizar um conteúdo didático sensivel e bem organizado, com tudo que você precisa saber. Leia com atenção! quem te garante que não haverá algum teste surpresa!? <br> Outro pilar muito importante para o aprendizado é a interação, a troca de informações é o que mantém o processo interessante; converse com pessoas mais experientes, até mesmo com instrutores, ou compartilhe seu conhecimento com os novatos. Aguardamos você!</p> </div>
                    <div class="inf bot3"><h2 class="header-title animate-pop-in">Aprenda de maneira interativa</h2>
                    <p class="header-subtitle animate-pop-in ">Esse site é destinado a você que não suporta a didática monótona e pouco desafiadora das apostilas e cursos e que quer testar os seus conhecimentos e aprender coisas novas despendiosamente. <br> Acesse o conteúdo de onde quiser e quando quiser, para uma sessão rápida de aprendizado, acesso a um conteúdo didático em formato de histórias, exercicios rápidos e estimulantes que facilitam a memorização, e desbloqueie capitulos da sua grade ao subir de nível.</p></div>
                </div>
              </section>
              <a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px" href="https://unsplash.com/@gabrielgurrola?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Gabriel Gurrola"><span style="display:inline-block;padding:2px 3px"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-1px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M20.8 18.1c0 2.7-2.2 4.8-4.8 4.8s-4.8-2.1-4.8-4.8c0-2.7 2.2-4.8 4.8-4.8 2.7.1 4.8 2.2 4.8 4.8zm11.2-7.4v14.9c0 2.3-1.9 4.3-4.3 4.3h-23.4c-2.4 0-4.3-1.9-4.3-4.3v-15c0-2.3 1.9-4.3 4.3-4.3h3.7l.8-2.3c.4-1.1 1.7-2 2.9-2h8.6c1.2 0 2.5.9 2.9 2l.8 2.4h3.7c2.4 0 4.3 1.9 4.3 4.3zm-8.6 7.5c0-4.1-3.3-7.5-7.5-7.5-4.1 0-7.5 3.4-7.5 7.5s3.3 7.5 7.5 7.5c4.2-.1 7.5-3.4 7.5-7.5z"></path></svg></span><span style="display:inline-block;padding:2px 3px">Gabriel Gurrola</span></a>
            </main>         
            <div id="begra" class="begra-hide">
                <section id="signup" class="hide-signup">

                    <form id="insc" action="./_php/action.php" method="post">
                        <h1 id="titleinsc">Conte-nos sobre você</h1>
                        <h2 id="idade"><label for="idade" id="lidade" class="focus" >Data de Nascimento</label></h2>
                        <input name="idade" id="idade" type="date" class="inscform" >
                        <h2 id="nom"><label class="focus" for="nomeUsuario">Nome</label></h2>
                        <input name="nome" id="nomeUsuario" type="text" class="inscform" placeholder="Insira o seu Nome Completo" required>
                        <h2 id="use"><label class="focus" id="user" for="username">Apelido</label></h2>
                        <input name="username" id="username" type="text" class="inscform" placeholder="Como deseja ser chamado?" required>
                        <h2 id="ema"><label class="focus" id="emai" for="email">Email de acesso</label></h2>
                        <input id="email" name="email" class="inscform" type="email" placeholder="Email" required />
                        <div id="senha">
                             <img id="eye" class="eye" src="./_imagens/eye-hidden.png"/>
                             <h2 id="sen"><label class="focus" for="passw">Senha</label></h2>
                            <input name="senha" id="passw" type="password" class="inscform" placeholder="Insira sua senha" required/>
                        </div>
                        <input name="enviar"  type="submit" id="send" value="Continuar" >
                    </form>
                    <div id="alert-box">
                 
                    <?php 
                        if( $host =="eumotorista.portifoliotgm.esy.es/index.php?e1") {
                        echo ('<h3 id="alert-text-email">Email em Uso</h3>');
                        }  else { 
                            if ($host == "eumotorista.portifoliotgm.esy.es/index.php?e2"){ echo ('<h3 id="alert-text-email">Username Em Uso</h3>');
                            }
                        }
                            ?>
                    
                    </div>
        
                    <script src="./_scripts/changepw.js"></script>
                    <script src="./_scripts/openSignUp.js"></script>
                    <script>
                        
                        var video = document.getElementById("video2");
                        var playing=false;
                        
                        video.addEventListener('click',function(){
                           if(playing==false){
                               alert(playing);
                               playing=true; 
                           } else {
                               alert(playing);
                               playing=false;
                           }
                        });

                        window.addEventListener('scroll', function(){
                          if (playing == true){
                                video.className = "header-file videoFix";
                              
                            } else {
                                
                                video.className = "header-file videoRel";
                            }  
                        });
                    </script>
                    
                </section>
            </div>
<footer id="rodape">
          <a id="sobre" href="index.php">Sobre</a>
          <h3>Copyright 2018 - EuMotorista, All rights reserved.</h3>
          <h3 id ='valpha'>Versão Alpha</h3>
 </footer>

</body>
</html>