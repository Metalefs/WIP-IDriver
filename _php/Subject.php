<?php
    require_once (__DIR__.'/'.'../config/dbConfig.php');
    class Subject{
        private $subjectId;
        private $schoolId;
        private $subjectName;
        private $creationDate;
        private $description;
        private $introduction;
        private $totalExercises;
        /*Get the value of subjectId @return  mixed*/
        public function getSubjectId() {
            return $this->subjectId;
        }

        /* Set the value of subjectId @param   mixed  $subjectId   @return  self */
        private function setSubjectId($subjectId) {
            $this->subjectId = $subjectId;
        }

        /*Get the value of schoolId @return  mixed*/
        public function getSchoolId() {
            return $this->schoolId;
        }

        /* Set the value of schoolId @param   mixed  $schoolId   @return  self */
        private function setSchoolId($schoolId) {
            $this->schoolId = $schoolId;
        }

        /*Get the value of subjectName @return  mixed*/
        public function getSubjectName() {
            return $this->subjectName;
        }

        /* Set the value of subjectName @param   mixed  $subjectName   @return  self */
        private function setSubjectName($subjectName) {
            $this->subjectName = $subjectName;
        }

        /*Get the value of creationDate @return  mixed*/
        public function getCreationDate() {
            return $this->creationDate;
        }

        /* Set the value of creationDate @param   mixed  $creationDate   @return  self */
        private function setCreationDate($creationDate) {
            $this->creationDate = $creationDate;
        }

        /*Get the value of description @return  mixed*/
        public function getDescription() {
            return $this->description;
        }

        /* Set the value of description @param   mixed  $description   @return  self */
        private function setDescription($description) {
            $this->description = $description;
        }
        /*Get the value of description @return  mixed*/
        public function getIntroduction() {
            return $this->introduction;
        }

        /* Set the value of description @param   mixed  $description   @return  self */
        private function setIntroduction($introduction) {
            $this->introduction = $introduction;
        }
        
        public function getTotalExercises(){
            return $this->totalExercises;
        }
        
        private function setTotalExercises($totalExercises){
           $this->totalExercises = $totalExercises;
        }
        
        
        function __construct($subjectId){
            $dBConnection = dbConnect();
            $query = "select subjectId,school_schoolId,subjectName,creationDate,admin_account_id,description,introduction from `subject` where subjectId= '$subjectId';"; //Get all scores of the user
            $queryResult = $dBConnection->query($query);
            if(mysqli_affected_rows($dBConnection) == 1){
                $queryResultText = mysqli_fetch_array($queryResult);
                $this->setSubjectId($subjectId);
                $this->setSchoolId($queryResultText['school_schoolId']);
                $this->setSubjectName($queryResultText['subjectName']);
                $this->setCreationDate($queryResultText['creationDate']);
                $this->setDescription($queryResultText['description']);
                $this->setIntroduction($queryResultText['introduction']);
            }
            else{
                throw new Exception("Cannot access this subject.");
            }
            $dBConnection = dbConnect();
            $query = "select * from exercise ORDER BY exerciseId DESC LIMIT 1;"; //Get last exercise for this subject
            $queryResult = $dBConnection->query($query);
            if(mysqli_affected_rows($dBConnection) == 1){
                $queryResultText = mysqli_fetch_array($queryResult);
                $totalEx = $queryResultText['exerciseId'];
                $this->setTotalExercises($totalEx); 
            }else{
                throw new Exception("Cannot get Total Exercises from subject.");
            }
            
        }
    }
?>