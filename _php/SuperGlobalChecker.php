<?php
    /** 1 Refere-se à variável $_GLOBAL */
    define('GLOBAL',1);
    /** 2 Refere-se à variável $_SERVER */
    define('SERVER',2);
    /** 3 Refere-se à variável $_GET */
    define('GET',3);
    /** 4 Refere-se à variável $_POST */
    define('POST',4);
    /** 5 Refere-se à variável $_FILES */
    define('FILES',5);
    /** 6 Refere-se à variável global $_COOKIE */
    define('COOKIE',6);
    /** 7 Refere-se à variável global $_SESSION */
    define('SESSION',7);
    /** 8 Refere-se à variável global $_REQUEST */
    define('REQUEST',8);
    /** 9 Refere-se à variável global $_ENV */
    define('ENV',9);
    class SuperGlobalChecker{
        private $requiredObjects;
        private $SuperGlobalType;

        /*Get the value of requiredObjects @return  mixed*/
        private function getRequiredObjects() {
            return array($this->requiredObjects);
        }
        /* Set the value of requiredObjects @param   mixed  $requiredObjects   @return  self */
        private function setRequiredObjects($requiredObjects) {
            $this->requiredObjects = $requiredObjects;
        }

        /*Get the value of SuperGlobalType @return  mixed*/
        public function getSuperGlobalType() {
            return $this->SuperGlobalType;
        }

        /* Set the value of SuperGlobalType @param   mixed  $SuperGlobalType   @return  self */
        public function setSuperGlobalType(int $SuperGlobalType) {
            $this->SuperGlobalType = $SuperGlobalType;
        }
         /**
          * SuperGlobalChecker é um objeto que pode ser utilizado para
          * checar a existência de variáveis super globais, que recebem
          * uma constante desta classe.
          * 1 Refere-se à variável $_GLOBAL
          * 2 Refere-se à variável $_SERVER
          * 3 Refere-se à variável $_GET
          * 4 Refere-se à variável $_POST
          * 5 Refere-se à variável $_FILES
          * 6 Refere-se à variável global $_COOKIE
          * 7 Refere-se à variável global $_SESSION
          * 8 Refere-se à variável global $_REQUEST
          * 9 Refere-se à variável global $_ENV
          **/
        function __construct($superGlobal){
            $this->requiredObjects = array();
            $this->SuperGlobalType = $superGlobal;
        }
        /**
         * Adiciona uma super global para ser checada
         * @var string $sessionObjectName recebe o nome da super global
         **/
        public function addObject($sessionObjectName){
            $requireObjectsSize = count($this->requiredObjects); //resgata o tamanho da variável
            $this->requiredObjects = array_pad($this->requiredObjects,$requireObjectsSize+1,$sessionObjectName);
        }
        /**
         * Remove a última super global adicionada
         **/
        public function removeLastObject(){
            $requireObjectsSize = count($this->requiredObjects); //resgata o tamanho da variável
            $this->requiredObjects = array_splice($this->requiredObjects,$requireObjectsSize-1);
        }
        /**
         * Testa a existencia de cada variável super global adicionada
         * e retorna um valor booleano.
         * true caso todas as variaveis existam.
         * false caso ao menos uma delas não exista.
         **/
        public function testExistence(){
            $requireObjectsSize = count($this->requiredObjects); //resgata o tamanho da variável
            $result=true;
            switch($this->SuperGlobalType){
                case 1:
                for($i=0;$i<$requireObjectsSize;$i++){
                    if(!isset($_GLOBALS[$this->requiredObjects[$i]])||empty($_GLOBALS[$this->requiredObjects[$i]])){
                        $result=false;
                        $i=$requireObjectsSize;
                    }
                }
                break;
                case 2:
                for($i=0;$i<$requireObjectsSize;$i++){
                    if(!isset($_SERVER[$this->requiredObjects[$i]])||empty($_SERVER[$this->requiredObjects[$i]])){
                        $result=false;
                        $i=$requireObjectsSize;
                    }
                }
                break;
                case 3:
                for($i=0;$i<$requireObjectsSize;$i++){
                    if(!isset($_GET[$this->requiredObjects[$i]])||empty($_GET[$this->requiredObjects[$i]])){
                        $result=false;
                        $i=$requireObjectsSize;
                    }
                }
                break;
                case 4:
                for($i=0;$i<$requireObjectsSize;$i++){
                    if(!isset($_POST[$this->requiredObjects[$i]])||empty($_POST[$this->requiredObjects[$i]])){
                        $result=false;
                        $i=$requireObjectsSize;
                    }
                }
                break;
                case 5:
                for($i=0;$i<$requireObjectsSize;$i++){
                    if(!isset($_FILES[$this->requiredObjects[$i]])||empty($_FILES[$this->requiredObjects[$i]])){
                        $result=false;
                        $i=$requireObjectsSize;
                    }
                }
                break;
                case 6:
                for($i=0;$i<$requireObjectsSize;$i++){
                    if(!isset($_COOKIE[$this->requiredObjects[$i]])||empty($_COOKIE[$this->requiredObjects[$i]])){
                        $result=false;
                        $i=$requireObjectsSize;
                    }
                }
                break;
                case 7:
                    for($i=0;$i<$requireObjectsSize;$i++){
                        if(!isset($_SESSION[$this->requiredObjects[$i]])||empty($_SESSION[$this->requiredObjects[$i]])){
                            $result=false;
                            $i=$requireObjectsSize;
                        }
                    }
                break;
                case 8:
                for($i=0;$i<$requireObjectsSize;$i++){
                    if(!isset($_REQUEST[$this->requiredObjects[$i]])||empty($_REQUEST[$this->requiredObjects[$i]])){
                        $result=false;
                        $i=$requireObjectsSize;
                    }
                }
                break;
                case 9:
                for($i=0;$i<$requireObjectsSize;$i++){
                    if(!isset($_ENV[$this->requiredObjects[$i]])||empty($_ENV[$this->requiredObjects[$i]])){
                        $result=false;
                        $i=$requireObjectsSize;
                    }
                }
                break;
            }
            return $result;
        }

    }
?>