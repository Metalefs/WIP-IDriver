<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Capacitação de motoristas de forma gameficada">
    <meta name="keywords" content="Direção,Habilitacao,CNH,Direcao,Habilitação,Auto-Escola">
    <meta name="author" content="Faciweb">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eumotorista</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/tela1.css">
    <link rel="stylesheet" type="text/css" href="signup-error-behavior.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
            <img id="tempicon" src="../_imagens/wheel.png">
            <a id="title" href="../index.php">EuMotorista</a>
            <p class="header-button animate-pop-in"><a id="scroll" class="button" onclick="signup()">Comece hoje</a></p>
        </nav>
        
            <main id="top">
              <section class="header-content">
                    <figure>
                        <img class="" src="../_imagens/ddcover.jpg">
                    </figure>
                    <div class="direito">
                            <h1 class="">Dê um kickstart no seu sonho de dirigir!</h1>
                            <h3 id="dir" class="">O Auto-tela é a melhor plataforma de aprendizado e preparação para testes de direção, com sua didática divertida e incentivos eficientes para estimular o aprendizado de forma inconsciente.</h3></div>
                        <form id="login" action="./_php/action.php">
                            <h2><legend>Entre com o seu perfil</legend></h2>
                            <input name="email" id="email-top" class="login" type="email" placeholder="Email de acesso">
                            <input name="senha" id="pass-top" class="login" type="password" placeholder="Senha de acesso">
                            <input type="submit" name="enviar" class="login" id="log" value="Login">
                        </form> 
              </section>       
              <section id="demo">
                <div class="inf bot1" ><h2 class="header-title animate-pop-in ">Ganhe Pontos!</h2>
                <h3 class="header-subtitle animate-pop-in ">Seu aprendizado fica muito mais interessante (até mesmo viciante) quando existem desafios e recompensas em jogo. Teste-se aprimore-se com seus erros, e se supere, desbrave o mundo da direção e crie sua história conosco!</h3>
                </div>
                
                <div class="inf bot2"><h2 class="header-title animate-pop-in">Aprenda de maneira interativa</h2>
                <h3 class="header-subtitle animate-pop-in ">Esse site é destinado a você que não suporta a didática monótona e pouco desafiadora das apostilas e cursos e que quer testar os seus conhecimentos e aprender coisas novas despendiosamente. <br> Acesse o conteúdo de onde quiser e quando quiser, para uma sessão rápida de aprendizado, acesso a um conteúdo didático em formato de histórias, exercicios rápidos e estimulantes que facilitam a memorização, e desbloqueie capitulos da sua grade ao subir de nível.</h3></div>
                <div class="inf bot3"><h2 class="header-title animate-pop-in ">Acervo de Leitura e Interação com outros alunos</h2>
                <h3 class="header-subtitle animate-pop-in">Sabemos que a leitura é vital para o sucesso em qualquer área, e que geralmente deixamos de fazer por falta de organização. Por isso, fazemos questão de disponibilizar um conteúdo didático sensivel e bem organizado, com tudo que você precisa saber. Leia com atenção! quem te garante que não haverá algum teste Surpresa!? <br> Outro pilar muito importante para o aprendizado é a interação, a troca de informações é o que mantém o processo interessante; converse com pessoas mais experientes, até mesmo com instrutores, ou compartilhe seu conhecimento com os novatos. Aguardamos você!</h3> </div>   
              </section>
            </main>         
            <div id="begra" class="begra-show">
                <section id="signup" class="show-signup">

                    <form id="insc" action="../_php/action.php" method="post">
                        <h1 id="titleinsc">Conte-nos sobre você</h1>
                         <h2 id="idade"><label for="idade" id="lidade" class="focus" >Data de Nascimento</label></h2>
                        <input name="idade" id="idade" type="date" class="inscform" placeholder="Insira a sua idade (nos ajuda a melhorar)" >
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
                    <h3 id="alert-text-nome">Username em Uso</h3>
                    <h3 id="alert-text-email"></h3>
                    <h3 id="alert-text-senha"></h3>
                    </div>
                    <script src="../_scripts/changepw.js"></script>
                    <script src="signup-error-behavior.js"></script>
                </section>
            </div>
        <?php 
        include_once '../footer.php';
        ?>
</body>
</html>