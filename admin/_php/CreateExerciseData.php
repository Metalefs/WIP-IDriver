<?php
    require_once (__DIR__.'/'.'../../config/dbConfig.php');
    function getExerciseSubject(){
        $dbConnection = dbConnect();
        $query = "select subjectId,subjectName from `subject` where subjectId!='1';";
        $queryResultText = $dbConnection->query($query);
        $column1 = array(null);
        $column2 = array(null);
        $i=0;
        while ($row =  mysqli_fetch_assoc($queryResultText)) {
            $column1[$i]=$row["subjectId"];
            $column2[$i]=$row["subjectName"];
            $i++;
            array_pad($column1,$i+1,"");
            array_pad($column2,$i+1,"");
        }
        array_slice($column1,$i,"");
        array_slice($column2,$i,"");
        return array($column1,$column2);
    }
?>