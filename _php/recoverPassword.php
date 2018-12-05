<?php 
    require_once (__DIR__.'/'.'../config/dbConfig.php');
    if(!isset($_SESSION)){session_start();} 
	require_once (__DIR__.'/'.'/Account.php');
	require_once (__DIR__.'/'.'/SuperGlobalChecker.php');
    $sessionChecker = new SuperGlobalChecker(7);
	$sessionChecker->addObject("userAccount");

    $email = "jack-ten@hotmail.com";
    $username = "Metalefs";
    $dBConnection = dbConnect();
   


    $password = rand(999, 99999);
    $password_hash = md5($password);
    
   
    $usql = "UPDATE `Account` SET password='$password_hash' WHERE username='$username'";
    $result = mysqli_query($dBConnection, $usql);
    if($result){
        $to = $r['$email'];
        $subject = "Sua senha recuperada";
        $message = "Por favor, use essa senha para entrar no EuMotorista" . $password;
        $headers = "From : eumotorista.k6.com.br";
        if(mail($to, $subject, $message, $headers)){
        	echo "Sua senha foi enviada por email.";
        }else{
        	echo "Erro ao recuperar a sua senha.";
        }
    }
   
    
?>  