<?php
    require_once (__DIR__.'/'.'../config/dbConfig.php');
    require_once (__DIR__.'/'.'Score.php');
    class Account {
        private $id; //ID of the object User
        private $userName; //Username of the object User
        private $email; //email of the object User
        private $name; //Name of the object user
        private $password; //Password of the object user
        private $birthDate; //User's birth date
        private $pictureId; //Picture ID
        private $description; //user's description
        private $accountExists; 
        private $theme; //the selected cosmetic theme for the site
        private $score; //the user's score
        private $level; //the user's level

        /*Get the value of id @return  mixed*/
        public function getId() {
            return $this->id;
        }

        /* Set the value of id @param   mixed  $id   @return  self */
        protected function setId($id) {
            $this->id = $id;
        }

        /* Get the value of userName @return  mixed */
        public function getUserName() {
            return $this->userName;
        }
        /* Set the value of userName @param   mixed  $userName   @return  self */
        protected function setUserName($userName) {
            $this->userName = $userName;
        }

        /* Get the value of email @return  mixed */
        public function getEmail() {
            return $this->email;
        }

        /* Set the value of email @param   mixed  $email   @return  self */
        protected function setEmail($email) {
            $this->email = $email;
        }

        /* Get the value of name @return  mixed */
        public function getName() {
            return $this->name;
        }

        /* Set the value of name @param   mixed  $name   @return  self */
        protected function setName($name) {
            $this->name = $name;
        }

        /* Get the value of password @return  mixed */
        public function getPassword() {
            return $this->password;
        }

        /* Set the value of password @param   mixed  $password   @return  self */
        protected function setPassword($password) {
            $this->password = $password;
        }

        /* Get the value of birthDate @return  mixed */
        public function getBirthDate() {
            return $this->birthDate;
        }

        /* Set the value of birthDate @param   mixed  $birthDate   @return  self */
        protected function setBirthDate($birthDate) {
            $this->birthDate = $birthDate;
        }

        /* Get the value of pictureId @return  mixed */
        public function getPictureId() {
            return $this->pictureId;
        }

        /* Set the value of pictureId @param   mixed  $pictureId   @return  self */
        protected function setPictureId($pictureId) {
            $this->pictureId = $pictureId;
        }

        /* Get the value of description @return  mixed */
        public function getDescription() {
            return $this->description;
        }

        /* Set the value of description @param   mixed  $description   @return  self */
        protected function setDescription($description) {
            $this->description = $description;
        }
        
        /*
         * Verifies if the connection is stablished and return a boolean 
         */
        private function setAccountExists($accountExists){
            $this->accountExists = $accountExists;
        }
        public function getAccountExists(){
            return $this->accountExists;
        }
        /*Get the value of theme @return  mixed*/
        public function getTheme() {
            return $this-> theme;
        }

        /* Set the value of theme @param   mixed  $theme   @return  self */
        private function setTheme($theme) {
            $this->theme = $theme;
            
        }
        public function updateTheme($theme) {
            
            if(is_nan($theme)||$theme > 254){
                throw new Exception("Error: $theme is an invalid input.");
            }
            else{
                
                $dBConnection = dbConnect();
                $query = "update account set theme='$theme' where id='".$this->getId()."';";
                $dBConnection->query($query);
                $theme = $theme;
                $this->setTheme($theme);
               
            }
        }
        /* Get the value of score @return  mixed */
        public function getScore() {
            return $this->score;
        }

        /* Set the value of score @param   mixed  $score   @return  self */
        private function setScore($score) {
            $this->score = $score;
        }
        /* Get the value of level @return  mixed */
        public function getLevel() {
            return $this->level;
        }

        /* Set the value of level @param   mixed  $level   @return  self */
        private function setLevel($level) {
            $this->level = $level;
        }
        public function levelUp($level) {
            
            $dBConnection = dbConnect();
            $query = "update account set level=$level where id=".$this->getId().";"; /**Query text**/
            $dBConnection->query($query);
            $this->setLevel($level);  //Change the level to the current level
            
        } 
        public function sessionate(){
           
            return array(
                'accountExists' => $this->getAccountExists(),
                'email' => $this->getEmail(),
                'password' => $this->getPassword(),
                'id' => $this->getId(),
                'name' => $this->getName(),
                'userName' => $this->getUserName(),
                'birthDate' => $this->getBirthDate(),
                'pictureId' => $this->getPictureId(),
                'description' => $this->getDescription(),
                'theme' => $this->getTheme(),
                'level' => $this->getLevel()
            );
        }
        public static function unsessionate($sessionArray){
            
            return new Account(
                $sessionArray['accountExists'],
                $sessionArray['email'],
                $sessionArray['password'],
                $sessionArray['name'],
                $sessionArray['userName'],
                $sessionArray['birthDate'],
                $sessionArray['pictureId'],
                $sessionArray['description'],
                $sessionArray['id'],
                $sessionArray['theme'],
                $sessionArray['level']
            );
        }
        public function createAccount(){
            
            $dBConnection = dbConnect();
            
            $this->name = mysqli_real_escape_string($dBConnection,$this->name);
            $this->userName = mysqli_real_escape_string($dBConnection,$this->userName);
            $this->email = mysqli_real_escape_string($dBConnection,$this->email);
            $this->password = mysqli_real_escape_string($dBConnection,$this->password);
            $this->birthDate = mysqli_real_escape_string($dBConnection,$this->birthDate);
            $query = "select * from account where username='".$this->getUserName()."';";
            $dBConnection->query($query);
            if(mysqli_affected_rows($dBConnection) == 0){
                $query = "select * from account where email='".$this->getEmail()."';";
                $dBConnection->query($query);
                if(mysqli_affected_rows($dBConnection) == 0){
                    $query = "INSERT INTO account (name,username,email,password,birthDate) VALUES ('".$this->getName()."','".$this->getUserName()."','".$this->getEmail()."','".$this->getPassword()."','".$this->getBirthDate()."');";
                    $dBConnection->query($query);
                    if(mysqli_affected_rows($dBConnection) == 1){ //Se funcionar
                        $this->setAccountExists(true);
                        return 0;
                    }
                    else{ //Erro desconhecido
                        return 3;
                    }
                }
                else{ //caso não funcione por existencia de email
                    return 1;
                }
            }
            else{ //caso não funcione por existencia de username
                return 2;
            }
        }
        
        /**
         * recieve the email and password as param to connect the database
         **/
        //AccountExists refere-se à se a conta já existe ou não True para sim False para não
        function __construct($accountExists=true,$mail, $pass,$name="",$username="",$birthDate="",$pictureId="",$description="",$id="",$theme="",$score="",$level=""){
            
            /*Set all attributes as paramethers*/
            $this->setId($id);
            $this->setEmail($mail);
            $this->setPassword($pass);
            $this->setName($name);
            $this->setUserName($username);
            $this->setBirthDate($birthDate);
            $this->setPictureId($pictureId);
            $this->setDescription($description);
            $this->setAccountExists($accountExists);
            $this->setTheme($theme);
            $this->setLevel($level);
            if($id != ""){
                $this->score = new Score($id);
            }
            //
            if(($username == ""||$name==""||$birthDate==""||$pictureId==""||$description==""||$theme=""||$level="")&&($this->accountExists==true)){
                $dBConnection = dbConnect();
                
                $mail = mysqli_real_escape_string($dBConnection,$mail);
                $pass = mysqli_real_escape_string($dBConnection,$pass);
                $query = "select id,name,username,birthDate,avatar_avatarId,description,theme,level from account where email='$mail' and password='$pass';"; //Query text
                $queryResult = $dBConnection->query($query); //store the result of the query
                if(mysqli_affected_rows($dBConnection) == 1){ //If the query has affected only 1 row
                    $queryResultText = mysqli_fetch_array($queryResult); //get the result of the query
                    //And store in the attributes
                    $this->setEmail($mail);
                    $this->setPassword($pass);
                    $this->setId($queryResultText['id']);
                    $this->setName($queryResultText['name']);
                    $this->setUserName($queryResultText['username']);
                    $this->setBirthDate($queryResultText['birthDate']);
                    $this->setPictureId($queryResultText['avatar_avatarId']);
                    $this->setDescription($queryResultText['description']);
                    $this->setTheme($queryResultText['theme']);
                    $this->setLevel($queryResultText['level']);
                }
                else{
                    throw new Exception("Error bad email or password");
                }
            }    
        }
    }
?>