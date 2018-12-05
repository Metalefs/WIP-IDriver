<?php
    require_once (__DIR__.'/'.'../config/dbConfig.php');
    function destroyData(){
        unset($adminAccount);
        unset($_POST['email']);
        unset($_POST['password']);
        echo($e);
        header("Location: ../index.php?error");
    }
    if(!isset($_SESSION)){session_start();} 
    require_once (__DIR__.'/'.'Account.php'); //User object
    require_once (__DIR__.'/'.'SuperGlobalChecker.php'); //
    $postChecker = new SuperGlobalChecker(4);
    $postChecker->addObject("usernameEmail");
    $postChecker->addObject("senha");
    if($postChecker->testExistence()){
        $email = $_POST['usernameEmail'];
        $senha = $_POST['senha'];
        try{
            $userAccount = new Account(true,$email,$senha); // accountExists , email, senha
            $_SESSION['userAccount']= $userAccount->sessionate();  // passes all user data to the session
            header("Location: ../cursos.php");
        } catch(Exception $e){
            echo "Could not Create account";
            destroyData();
        }
    }
    else{
        destroyData();
    }
?>
