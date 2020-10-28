<?php
    require_once (__DIR__.'/'.'../config/dbConfig.php');
    class Score {
        private $subjectScore = array(); //stores the subjectId and score for each subject
        private $totalScore; //stores user's total score
        /*Get the value of totalScore @return  mixed*/
        public function getTotalScore() {
            return $this->totalScore;
        }

        /* Set the value of totalScore @param   mixed  $totalScore   @return  self */
        private function setTotalScore($totalScore) {
            $this->totalScore = $totalScore;
        }
        /**
         * Returns the value of a field in subjectScore
         * Registry depends on how much subjects you have
         * column can be subjectId or score
         */
        public function getSubjectScore($registry,$column) {
            return $this->subjectScore[$registry][$column];
        }

        /**
         * Sets the value of a field in subjectScore
         * Registry depends on how much subjects you have
         * column can be subjectId or score
         * newValue can be any int value that you want to set to the user
         */
        private function setSubjectScore($registry,$column,$newValue) {
            $this->subjectScore[$registry][$column] = $newValue;
        }
        
        /**
        * Inserts new score from completing exercises into a new row
        * Updates the scoretable Table in the database
        * */
        
        public function updateScore($accountId,$subjectId,$score) {
            $dBConnection = dbConnect();
            $query = "update scoretable set score = score + $score where account_id = $accountId and subject_subjectId = $subjectId;";
            $dBConnection->query($query);
        }
        
        function __construct($accountId){
            $dBConnection = dbConnect();
            $query = "select subject_subjectId,score from scoretable where account_id='$accountId';"; //Get all scores of the user
            $queryResult = $dBConnection->query($query);
            if(mysqli_affected_rows($dBConnection) != 0){
                for($i=0;$queryResultText = mysqli_fetch_array($queryResult);$i++){ //While exists response from $queryResult
                    array_pad($this->subjectScore,$i+1,''); //add score to the array subjectScore
                    $this->subjectScore[$i] = array('subjectId' => $queryResultText[0],'score' => $queryResultText[1]); //give to the first column the name subjectId and to the second column the name score
                    $this->totalScore += $queryResultText[1]; //Increment totalscore with the last score taken
                }
            }
            else{
				
                unset($userAccount);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                throw new Exception("Cannot access your score.");
            }
        }
    }
?>