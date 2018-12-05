<?php
    function destroyData(){
        unset($adminAccount);
        unset($_POST['email']);
        unset($_POST['password']);
        echo($e);
        header("Location: index.php?error");
    }
    if(!isset($_SESSION)){session_start();} 
    require_once (__DIR__.'/'.'_php/Admin.php');
    require_once (__DIR__.'/'.'../_php/SuperGlobalChecker.php');
    $postChecker = new SuperGlobalChecker(4);
    $postChecker->addObject("email");
    $postChecker->addObject("password");
    if($postChecker->testExistence()){
        $email = $_POST['email'];
        $password = $_POST['password'];
        try{
            $adminAccount = new Admin($email,$password);
            if($adminAccount->getAdminLevel()>0){
                $_SESSION['adminAccount']= $adminAccount->sessionate();
                header("Location: selecaoDeFerramenta.php");
            }
            else{
                destroyData();
            }
        } catch(Exception $e){
            destroyData();
        }
    }
    else{
        destroyData();
    }
?>