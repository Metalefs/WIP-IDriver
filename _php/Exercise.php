<?php
    require_once (__DIR__.'/'.'../config/dbConfig.php');
    class Exercise{
        private $exerciseId;
        private $creationDate;
        private $subjectId;
        private $exerciseTitle;
        private $experienceProvided;
        private $author;
        private $correctAnswer;
        private $exercisePath;
        private $description;
        private $paths = array();
        private $numOfHits;
        private $numOfErrors;
        
        /*Get the value of exerciseId @return  mixed*/
        public function getExerciseId() {
            return $this->exerciseId;
        }

        /* Set the value of exerciseId @param   mixed  $subjectId   @return  self */
        private function setExerciseId($exerciseId) {
            $this->subjectId = $exerciseId;
        }

        /*Get the value of  @return  mixed*/
        public function getCreationDate() {
            return $this->creationDate;
        }

        /* Set the value of creationDate @param   mixed  $schoolId   @return  self */
        private function setCreationDate($creationDate) {
            $this->creationDate = $creationDate;
        }
        
        /* Set the value of subjectId @param   mixed  $schoolId   @return  self */
        private function setSubjectId($subjectId) {
            $this->subjectId = $subjectId;
        }
        
        /*Get the value of subjectId @return  mixed*/
        public function getSubjectId() {
            return $this->subjectId;
        }
            
        /*Get the value of exerciseTitle @return  mixed*/
        public function getExerciseTitle() {
            return $this->exerciseTitle;
        }

        /* Set the value of exerciseTitle @param   mixed  $subjectName   @return  self */
        private function setExerciseTitle($exerciseTitle) {
            $this->exerciseTitle = $exerciseTitle;
        }

        /*Get the value of ExperienceProvided @return  mixed*/
        public function getExperienceProvided() {
            return $this->experienceProvided;
        }

        /* Set the value of experienceProvided @param   mixed  $creationDate   @return  self */
        private function setExperienceProvided($experienceProvided) {
            $this->experienceProvided = $experienceProvided;
        }

        /*Get the value of author @return  mixed*/
        public function getAuthor() {
            return $this->author;
        }

        /* Set the value of author @param   mixed  $description   @return  self */
        private function setAuthor($author) {
            $this->author = $author;
        }
        /*Get the value of correctAnswer @return  mixed*/
        public function getCorrectAnswer() {
            return $this->correctAnswer;
        }

        /* Set the value of correctAnswer @param   mixed  $description   @return  self */
        private function setCorrectAnswer($correctAnswer) {
            $this->correctAnswer = $correctAnswer;
        }
        /*Get the value of exercisePath @return  mixed*/
        public function getExercisePath(){
            return $this->exercisePath;
        }
         /* Set the value of exercisePath @param   mixed  $description   @return  self */
        private function setExercisePath($exercisePath){
           $this->exercisePath = $exercisePath;
        }
        /*Get the value of exercisePath @return  mixed*/
        public function getDescription(){
            return $this->description;
        }
         /* Set the value of numOfHits @param   mixed  $numOfHits   @return  self */
        private function setDescription($description){
           $this->description = $description;
        }
        public function getNumOfHits(){
            return $this->numOfHits;
        }
         /* Set the value of numOfHits @param   mixed  $numOfHits   @return  self */
        private function setNumOfHits($numOfHits){
           $this->numOfHits = $numOfHits;
        }
        public function getNumOfErrors(){
            return $this->numOfErrors;
        }
         /* Set the value of numOfErrors @param   mixed  $numOfHits   @return  self */
        private function setNumOfErrors($numOfErrors){
           $this->numOfErrors = $numOfErrors;
        }
        public function getPaths(){
            return $this->paths;
        }
        
        function __construct($subjectId){
            $dBConnection = dbConnect();
            $query = "select exerciseId,creationDate,subject_subjectId,exerciseTitle,experienceProvided,admin_account_id,correctAnswer,exercisePath,description,numOfHits,numOfErrors from `exercise` where  subject_subjectId = $subjectId;"; //Get all scores of the user
            $queryResult = $dBConnection->query($query);
            if(mysqli_affected_rows($dBConnection) != 0){
                $queryResultText = mysqli_fetch_array($queryResult);
                $this->setSubjectId($subjectId);
                $this->setExerciseId($queryResultText['exerciseId']);
                $this->setCreationDate($queryResultText['creationDate']);
                $this->setExerciseTitle($queryResultText['exerciseTitle']);
                $this->setExperienceProvided($queryResultText['experienceProvided']);
                $this->setAuthor($queryResultText['admin_account_id']);
                $this->setCorrectAnswer($queryResultText['correctAnswer']);
                $this->setExercisePath($queryResultText['exercisePath']);
                $this->setDescription($queryResultText['description']);
                $this->setNumOfHits($queryResultText['numOfHits']);
                $this->setnumOfErrors($queryResultText['numOfErrors']);
            }
            else{
                throw new Exception("Cannot access this exercise.");
            }
            $dBConnection = dbConnect();
            $query = "select exercisePath from `exercise` where subject_subjectId = $subjectId ;"; //Get all scores of the user
            $queryResult = $dBConnection->query($query);
            if(mysqli_affected_rows($dBConnection) != 0){
                for($i=0;$queryResultText = mysqli_fetch_array($queryResult);$i++){ //While exists response from $queryResult
                    
                    $this->paths[$i] =  $queryResultText[0]; //
                    
                }
            }
            else{
                throw new Exception("Cannot access this Exercise.");
            }
            
        }
    }
?>