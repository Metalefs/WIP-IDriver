<?php 

	unset($_SESSION['userAccount']);
	
	session_destroy();

	header("Location:index.php");
?>