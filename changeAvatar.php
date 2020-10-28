<?php
  if(!isset($_SESSION)){session_start();} 
	require_once (__DIR__.'../'.'_php/Subject.php');
	require_once (__DIR__.'../'.'_php/Account.php');
	require_once (__DIR__.'../'.'_php/SuperGlobalChecker.php');
    $sessionChecker = new SuperGlobalChecker(7);
	$sessionChecker->addObject("userAccount");
	$existenceTest = $sessionChecker->testExistence();
	if(!$existenceTest){header("Location: index.php?error");}
	else{
		try{
            $userAccount = Account::unsessionate($_SESSION['userAccount']);
            if($userAccount->getTheme() == null){header("Location: ../cursos.php");}
        }
        catch(Exception $e){header("Location: index.php?error");}
	}
    require_once (__DIR__.'/'.'/config/dbConfig.php');
    if(!isset($_SESSION)){session_start();} 
    
    $avatarId = $_POST['avatarId'];
    $userAccount = Account::unsessionate($_SESSION['userAccount']);
    $userAccount->setId($avatarId);
    $_SESSION['userAccount']['pictureId']=$avatarId;
?>