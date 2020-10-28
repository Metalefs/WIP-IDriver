<!DOCTYPE html>
<?php
    $GLOBALS['index'] = true;
    require_once (__DIR__.'/'.'../_php/SuperGlobalChecker.php');
    require_once (__DIR__.'/'.'_php/nav-admin.php');
    if(!isset($_SESSION)){session_start();} 
    $sessionChecker = new SuperGlobalChecker(7);
    $sessionChecker->addObject("adminAccount");
    $existenceTest = $sessionChecker->testExistence();
    if($existenceTest){
        header("Location: selecaoDeFerramenta.php");   
    }
?>   
    <h1 id="header"span style="text-align: center;">Entrar como administrador</h1>
    <form class="formlogin" action="adminLoginAction.php" method="post">
        <input name="email" id="email" type="text" placeholder="E-mail">
        <br/><br/>
        <input name="password" id="password" type="password" placeholder="senha">
        <br/><br/>
        <input name="submit" id="submit" type="submit" value="Entrar">
        <?php if(isset($_GET['error'])){echo("<br/>E-mail ou senha incorretos.");}?>
    </form>
<?php 
    require_once'../_php/footer-in.php'
    ?>
    </body>
</html>