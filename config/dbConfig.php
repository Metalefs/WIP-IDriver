<?php
  if(!isset($_SESSION)){session_start();}
  if(!defined('DB_USER')){
    define('DB_USER', 'eu'); 	//User of the database (DEFAULT - eu)
    define('DB_PASS', 'password');  //Password of the database's user (DEFAULT - mysql)
    define('DB_HOST', 'localhost');   //IP address of the server (DEFAULT - 127.0.0.1)
    define('DB_NAME', 'eumotorista'); //Database used
  }
  if(!function_exists("dbConnect")){
      function dbConnect(){
		$dBConnection = mysqli_init();
		if (!$dBConnection) {
			die('mysqli_init failed');
		}

		if (!$dBConnection->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
			die('Setting MYSQLI_INIT_COMMAND failed');
		}

		if (!$dBConnection->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10000)) {
			die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
		}

		if (!$dBConnection->real_connect('localhost', 'eu', 'password', 'eumotorista')) { //DB_HOST,DB_USER,DB_PASS,DB_NAME
			die('Connect Error (' . mysqli_connect_errno() . ') '
					. mysqli_connect_error());
		}
		$dBConnection->set_charset("utf8"); //Set the object's charset, so, it can works with latin characters.
		return $dBConnection;
      }
  }
?>