<?php
    require_once (__DIR__.'/'.'../../config/dbConfig.php');
    require_once (__DIR__.'/'.'../../_php/Account.php');
    class Admin extends Account {
        private $adminLevel;
            

        /*Get the value of adminLevel @return  mixed*/
        public function getAdminLevel() {
            return $this->adminLevel;
        }

        /* Set the value of adminLevel @param   mixed  $adminLevel   @return  self */
        private function setAdminLevel($adminLevel) {
            $this->adminLevel = $adminLevel;
        }
        public function sessionate(){
            return array(
                'email' => parent::getEmail(),
                'password' => parent::getPassword(),
                'id' => parent::getId(),
                'name' => parent::getName(),
                'userName' => parent::getUserName(),
                'birthDate' => parent::getBirthDate(),
                'pictureId' => parent::getPictureId(),
                'description' => parent::getDescription(),
                'adminLevel' => $this->getAdminLevel()
            );
        }
        public static function unsessionate($sessionArray){
            return new Admin(
                $sessionArray['email'],
                $sessionArray['password'],
                $sessionArray['id'],
                $sessionArray['name'],
                $sessionArray['userName'],
                $sessionArray['birthDate'],
                $sessionArray['pictureId'],
                $sessionArray['description'],
                $sessionArray['adminLevel']
            );
        }
        function createAccount(){
            return null;
        }
        function __construct($mail, $pass,$id="",$name="",$username="",$birthDate="",$pictureId="",$description="",$adminLevel=""){
            /*Set all attributes as paramethers*/
            parent::setId($id);
            parent::setEmail($mail);
            parent::setPassword($pass);
            parent::setName($name);
            parent::setUserName($username);
            parent::setBirthDate($birthDate);
            parent::setPictureId($pictureId);
            parent::setDescription($description);
            $this->setAdminLevel($adminLevel);
            if($username == ""||$id ==""||$name==""||$birthDate==""||$pictureId==""||$description==""||$adminLevel=""){
            /** */
                $dBConnection = dbConnect();
                $mail = mysqli_real_escape_string($dBConnection,$mail);
                $pass = mysqli_real_escape_string($dBConnection,$pass);
                $query = "select id,name,username,birthDate,avatar_avatarId,description from account where email='$mail' and password='$pass';"; //Query text
                $queryResult = $dBConnection->query($query); //store the result of the query
                if(mysqli_affected_rows($dBConnection) == 1){ //If the query has affected only 1 row
                    $queryResultText = mysqli_fetch_array($queryResult); //get the result of the query
                    //And store in the attributes
                    $idd = $queryResultText['id'];
                    parent::setEmail($mail);
                    parent::setPassword($pass);
                    parent::setId($queryResultText['id']);
                    parent::setName($queryResultText['name']);
                    parent::setUserName($queryResultText['username']);
                    parent::setBirthDate($queryResultText['birthDate']);
                    parent::setPictureId($queryResultText['avatar_avatarId']);
                    parent::setDescription($queryResultText['description']);
                    $query = "select adminLevel from admin where account_id='$idd';"; //Query text
                    $queryResult = $dBConnection->query($query); //store the result of the query
                    if(mysqli_affected_rows($dBConnection) == 1){
                        $queryResultText = mysqli_fetch_array($queryResult); //get the result of the query
                        $this->setAdminLevel($queryResultText['adminLevel']);
                    }
                    else{
                        throw new Exception("Error: You have no adminstration permission.");
                    }
                }
                else{
                    throw new Exception("Error: bad email or password.");
                }
            }   
        }
    }
?>
