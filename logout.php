<?php 
    session_start();
	unset($_SESSION['userAccount']);
	 // 3. Destroy the session cookie
   
    $_SESSION = array();
    session_destroy();
    session_unset();

	header("Location:index.php");
?>