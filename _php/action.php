<?php 
    require_once (__DIR__.'/'.'../config/dbConfig.php');
    if(!isset($_SESSION)){session_start();} 
    require_once 'Account.php';
    //get POST,remove specialchars, remove spaces
    $idade= $nome = $username = $email = $senha =  $enviar = "";///INITIALIZING VARIABLES
    $userAccount = new Account(false,$_POST['email'],$_POST['senha'],$_POST['nome'],$_POST['username'],$_POST['idade']);
    $result = $userAccount->createAccount();
    if($result==0){
        $_SESSION['userAccount']=$userAccount->sessionate();
        header("Location: ../cursos.php");
    }
    else if($result==1){
        header("Location: ../index.php?e1");
    }
    else if($result==2){
        header("Location: ../index.php?e2");
    }
    else if($result==3){
        header("Location: ../index.php?e3");
    }
?>  