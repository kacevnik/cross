<?php
    include("core.php");
    
    $selIdUser = 0;
    
    if($_SESSION["admin"]){
        $selIdUser = getIdFromSes($_SESSION['admin']);   
    }
    
    if (isset($_POST['answer']))    {$answer = $_POST['answer'];   $answer = trim(stripslashes(htmlspecialchars($answer)));}
    if (isset($_POST['cross']))     {$cross = $_POST['cross'];     $cross = (int)abs($cross);}
    if (isset($_POST['sec']))       {$sec = $_POST['sec'];         $sec = (int)abs($sec);}

    $data= array();
    
    if(!preg_match('/1/', $answer)){unset($answer);}
    if(!$answer){
        $data['error_message'] .= '<div class="error">Поле кроссворда пустое, заполните его</div>'; $data['type'] = 1;
    }else{   
        $selCross = mysqli_query($db, "SELECT otvet FROM dk_cross WHERE id='$cross' AND type='1' LIMIT 1");
        if(mysqli_num_rows($selCross) > 0){
            $resCross = mysqli_fetch_assoc($selCross);
            $solutionCross = $resCross['otvet'];
        }else{
            $data['error_message'] .= '<div class="error">Ошибка запроса. Попробуйте еще раз</div>'; $data['type'] = 1;
        }
    }
    
    $procent = getAnswerProcent($answer, $solutionCross);
    
    if($answer and $cross and $sec){
        if($selIdUser > 0){
            if(mysqli_query($db, "UPDATE solution SET history='$answer',sec_history='$sec' WHERE id_cross='$cross' AND id_user='$selIdUser'")){
                $data['error_message'] .= '<div class="error_plus">Кроссворд решен на: <strong>'.$procent.' %</strong>.<br>Решение сохранено!</div>'; $data['type'] = 2;   
            }else{
                $data['error_message'] .= '<div class="error">Ошибка запроса. Попробуйте еще раз</div>'; $data['type'] = 1;
            }
        }else{
            $data['error_message'] .= '<div class="error">Чтобы сохранить результат,<br>следует войти в личный кабинет.</div>'; $data['type'] = 1;
        }
    }
    
    echo json_encode($data);
?>