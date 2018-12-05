<?php 
    function getAllSubjects(){
        require_once __DIR__.'/'.'../config/dbConfig.php';
        $dBConnection = dbConnect();
        $query = "select max(subjectId) from `subject`;"; //Get all scores of the user
        $queryResult = $dBConnection->query($query);
        if(mysqli_affected_rows($dBConnection) == 1){
          
            return  $queryResult;
        }
    }
    echo "
                        <a href='activity-info.php?subjectId=2'>

                            <div id='subject0' name='subject0' class='subject'><p class='sub-name'>Sinalização</p>
                               
                            </div>

                        </a>

                            <div id='subject1' name='subject1' class='subject right locked'><p class='sub-name'>Processo de Habilitação</p>
                            </div>     

                
                    
                        <div id='subject2' name='subject2' class='subject locked'><p id='subname1' class='sub-name'>Legislação</p></div> 

                        <div id='subject3' name='subject3' class='subject right locked'><p class='sub-name'>Normas de Circulação e Conduta</p></div>  
                        <!--<div id='lock1' class='lock'><img src='_imagens/lock.png' alt='unlock next chapter'></div> -->
                    

                

                    <div id='subject4' name='subject4' class='subject locked' ><p class='sub-name'>Infrações e Penalidades</p></div>

                    <div id='subject5' name='subject5'class='subject right locked'><p class='sub-name'>Dirigindo com Segurança</p></div>

                 
                    
                        <div id='subject6' name='subject6' class='subject locked' ><p class='sub-name '>Noções de Veiculo</p></div>

                        <div id='subject7' name='subject7'class='subject right locked'><p class='sub-name'>Primeiros Socorros</p></div>
                    "
        ;
    
?>