<?php 
require_once 'dbConnect.php';

//get POST,remove specialchars, remove spaces
$title= $subject = $description = $question = $alt1 = $alt2 = $alt3 = $alt4 = $alt5 = $answer = $image = $imageName = $points = $author="";///INITIALIZING VARIABLES


    $title = $_POST['title'];

    $subject = $_POST['subject'];

    $description = $_POST['desc'];

    $question =  $_POST['enunciado'];
    
    $image = $_FILES['imageUp'];

    $imageName = $_FILES['imageUp']['name'];
    
    $answers =$_POST['answer'];
    
    $corrAnswer = $_POST['correctAnswer'];
    
     if(isset($_POST["answer"]) && is_array($_POST["answer"])){
    $answerArray = implode(", ", $answer); 
    $jsonAnswer = json_encode($_POST["answer"]);     
     }

    $points = mysqli_real_escape_string($conn,$_POST['score']);

    $author = mysqli_real_escape_string($conn,$_POST[$sessionArray['name']]);

    $data_envio = date('d/m/Y');
    $hora_envio = date('H:i:s');
    $data_hora = $data_envio." as ".$hora_envio;

//trimData(); // (test_input) -> remove specialchars, remove spaces

//ERROR HANDLERS - check if the form was submitted
if (!empty($_POST)) {
    if (empty($answers) || empty($subject) || empty($question) || empty($corrAnswer) || empty($points)) 
    {
        header("Location: ../_errorpages/exercise-creation=error.php");
        echo "Campo Vazio";
    } /* else 
        { //Check something else            
            if ()) 
            {
              header("Location: ../_errorpages/");
              echo '';
             } 
         }*/
}   

    $exercise -> creationDate = "21/09/18";
    $exercise -> author = "JACKSON";
    $exercise -> title = $title;
    $exercise -> subjectName = $subject;
    $exercise -> description = $description;
    $exercise -> question = $question;
    $exercise -> alt1 = $alt1;
    $exercise -> answer = $answerArray;
    $exercise -> image = $imageName;
    $exercise -> exp = $points;
    $name="../exercises/".$subject."01";
    mkdir($name);
    $myJSON = json_encode($exercise);
        $fp=fopen($name.'exercises.json','w+');
                 fwrite($fp, $myJSON);
                 fclose($fp);
    
//////////////////////////////////////////////////////////////////////////////
//SQL QUERY FOR UNIQUE COLUMS
/*
        $query1 = "SELECT * FROM exercises WHERE title = '$title';";
        $result = mysqli_query($conn, $query1);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
                header("Location: ../_errorpages/exercise-creation=title-exists.php");
                 exit();
        } else {
        
            $targetFile = './_uploads/' . basename($_FILES["imgUpload"]["name"]);
            move_uploaded_file($_FILES["imgUpload"]["name"], $targetFile);

            //INSERT EXERCISE INTO DATABASE
            $sql= "INSERT INTO `exercises`(`creationDate`,`author`,`title`, `subjectName`, `descr`, `question`, `alt1`, `alt2`, `alt3`,`alt4`,`alt5`,`answer`,`image`,`exp`) VALUES ('$data_envio','$author','$title','$subject','$description','$question','$alt1','$alt2','$alt3','$alt4','$alt5','$answer','$imageName','$points');"; //Query text for - TABLE exercises 

            if ($conn->query($sql) === TRUE) {
                         
                header("Location: ../cursos.php");
                exit();
                } else
                    {
                
                         header("Location: ../exercise-creation=error.php");
                      
                    } 

    }
 ?>  */