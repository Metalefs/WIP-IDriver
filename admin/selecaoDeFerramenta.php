<!DOCTYPE html>
<?php
    require_once (__DIR__.'/'.'_php/Admin.php');
    require_once (__DIR__.'/'.'../_php/SuperGlobalChecker.php');
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
    require_once (__DIR__.'/'."_php/nav-admin.php");  
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/development.css">
    <title>Document</title>
    <title>Criar novo módulo</title>
</head>
    <div class="systemDevelopment">
        <h3 span style="text-align: center;">Página de criação:</h3><br><h1 span style="text-align: center; margin-top:0px; box-shadow:1px 3px 3px black; background-color: rgba(0,255,255,0.1)"> Selecione o tipo de conteúdo a ser criado</h1>
        <button class="btn" type="button" onclick="window.location.href = 'criarModulo.php'">Criar Material de Estudo</button>
        <button class="btn sec" type="button" onclick="window.location.href = 'createExercise.php'">Criar exercício</button>
        <button class="btn" type="button" onclick="window.location.href = 'createExercise.php'">Editar Exercicios</button>
        <button class="btn sec" type="button" onclick="window.location.href = 'createExercise.php'">Criar Disciplinas</button>
        <button class="btn" type="button" onclick="window.location.href = 'createExercise.php'">Editar Disciplinas</button>
    </div>
    <?php
    require_once "../_php/footer-in.php";  
    
?>
</html>