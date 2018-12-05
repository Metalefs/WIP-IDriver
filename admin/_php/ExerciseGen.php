<?php
    require_once (__DIR__.'/'.'Admin.php');
    require_once (__DIR__.'/'.'../../_php/SuperGlobalChecker.php');
    if(!isset($_SESSION)){session_start();} 
    $sessionChecker = new SuperGlobalChecker(7);
    $sessionChecker->addObject("adminAccount");
    $existenceTest = $sessionChecker->testExistence();
	if(!$existenceTest){header("Location: index.php?error");}
	else{
		try{$adminAccount = Admin::unsessionate($_SESSION['adminAccount']);}
		catch(Exception $e){header("Location: index.php?error");}
    }
?>
<?php
    $time = getdate();
    $time = $time['year'].'-'.$time['mon'].'-'.$time['mday'];
    $author = $adminAccount->getId();
    $questionTitle = $_POST['questionTitle'];
    $questionSubject = $_POST['questionSubject'];
    $questionDescription = $_POST['questionDescription'];
    $correctAnswer = $_POST['correctAnswer'];
    $score = $_POST['score'];
    $questionStatement = $_POST['questionStatement'];
    $questionAnswers = $_POST['questionAnswers'];
    $dbcon = dbConnect();
/**/
  
/**/
    $query ="insert into exercise (creationDate,subject_subjectId,exerciseTitle,experienceProvided,admin_account_id,correctAnswer,description,numOfHits,numOfErrors) values ('$time','$questionSubject','$questionTitle','$score','$author','$correctAnswer','$questionDescription',0,0);";
    $queryResult = $dbcon->query($query);
    if(mysqli_affected_rows($dbcon) == 1){
        $query = "select exerciseId from exercise where creationDate='$time' and subject_subjectId='$questionSubject' and experienceProvided='$score' and admin_account_id='$author' and correctAnswer='$correctAnswer' and description='$questionDescription' limit 1";
        $queryResult = $dbcon->query($query);
        if(mysqli_affected_rows($dbcon) == 1){
            $queryResultText = mysqli_fetch_array($queryResult);
            $questionId = $queryResultText['exerciseId'];
        } else{
            echo("Erro 1! Impossível criar o exercício. (numero de linhas afetadas diferente de 1 ao selecionar)");
            return 0;
        }
    } else{
        echo("Erro 2! Impossível criar o exercício. (numero de linhas afetadas diferente de 1 ao inserir)");
        return 0;
    }
    $path = "./content/".$questionSubject."/exercise/".$questionSubject.'_'.$questionId.'/'.$questionSubject.'_'.$questionId.'.json';
    $query = "update exercise set exercisePath='$path' where exerciseId='$questionId'";
    $queryResult = $dbcon->query($query);
    if(mysqli_affected_rows($dbcon) != 1){
        $query = "delete from exercise where id='$questionId';";
        $queryresult = $dbcon->query($query);
        echo("Erro 3! Impossível criar o exercício.");
        return 0;
    }
    $jsonPath = __DIR__.'/'.'../../content';
    if(!is_dir($jsonPath)){
        if(!mkdir($jsonPath)){
            echo("deu ruimm demais 1");
            return 0;
        }
    }
    $jsonPath = $jsonPath.'/'.$questionSubject;
    if(!is_dir($jsonPath)){
        if(!mkdir($jsonPath)){
            echo("deu ruimm demais 2");
            return 0;
        }
    }
    $jsonPath = $jsonPath.'/exercise';
    if(!is_dir($jsonPath)){
        if(!mkdir($jsonPath)){
            echo("deu ruimm demais 3");
            return 0;
        }
    }
    $jsonPath = $jsonPath.'/'.$questionSubject.'_'.$questionId;
    if(!is_dir($jsonPath)){
        if(!mkdir($jsonPath)){
            echo("deu ruimm demais 4");
            return 0;
        }
    }
    $jsonPath = $jsonPath.'/'.$questionSubject.'_'.$questionId.'.json';
    $exercise = new \stdClass();
    $exercise -> idExercise = $questionId;
    $exercise -> title = $questionTitle;
    $exercise -> subjectId = $questionSubject;
    $exercise -> author = $author;
    $exercise -> description = $questionDescription;
    $exercise -> questionStatement = $questionStatement;
    $exercise -> answer = $correctAnswer;
    $exercise -> exp = $score;
    $exercise -> alternatives = $questionAnswers;
    $myJSON = json_encode($exercise);
    $fp=fopen($jsonPath,'w+');
    fwrite($fp, $myJSON);
    fclose($fp);
    echo("Exercise created succefully!");


//CRIANDO UM DOCUMENTO COM O TITULO E DESCRIÇÃO DE TODOS OS EXERCICIOS -PARA CADA SUBJECT-, PARA EXIBI-LOS NA TELA DE ATIVIDADES
    
    
    $query2 ="SELECT exerciseId,exerciseTitle,description FROM exercise WHERE subject_subjectId = $questionSubject";
    $result = $dbcon->query($query2);

   $all_exercises = array();
                  if(count($result)>=0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $returnArray = array();
                        if (count($result) > 0) {
                             foreach ($result as $rs) {
                                $returnArray[] = $rs;
                             }
                        }
                      $document =  json_encode($returnArray);
                      $fp=fopen('__DIR__'.'/'.'../../content/'.$questionSubject.'/exercise/'.$questionSubject.'_'.$questionId.'.json','w+');
                      fwrite($fp, $all_exercises);
                      fclose($fp);

                      if ($returnArray>0) {
                              echo "Success";
                          }else {
                            echo "Error while creating file";
                          }

                          ini_set('display_errors', 1);

                          error_reporting(E_ALL);
                    }
                  }
?>