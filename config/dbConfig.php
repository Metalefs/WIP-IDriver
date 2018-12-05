<?php
  if(!isset($_SESSION)){session_start();}
  if(!defined('DB_USER')){
    
    define('DB_USER', 'u911430744_gui'); //User of the database (DEFAULT - gui)
    define('DB_PASS', '112233500'); //Password of the database's user (DEFAULT - mysql)
    define('DB_HOST', 'localhost'); //IP address of the server (DEFAULT - 127.0.0.1)
    define('DB_NAME', 'u911430744_eumot'); //Database used
    
  }
  if(!function_exists("dbConnect")){
      function dbConnect(){
          $dBConnection = mysqli_init();
          
          if($dBConnection->real_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)){ //Create the new object of the mysqli type.
              $dBConnection->set_charset("utf8"); //Set the object's charset, so, it can works with latin characters.
              return $dBConnection;
          } else {
            if (!$dBConnection) {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
          }
            echo "Success: A proper connection to MySQL was made!" . PHP_EOL;
            echo "Host information: " . mysqli_get_host_info($dBConnection) . PHP_EOL;
         
      }
  }
?>