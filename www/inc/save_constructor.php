<?php
    include("core.php");
    
    $selIdUser = 0;
    
    if($_SESSION["admin"]){
        $selIdUser = getIdFromSes($_SESSION['admin']);   
    }
    
    if (isset($_POST['answer']))    {$answer = $_POST['answer'];     $answer = trim(stripslashes(htmlspecialchars($answer)));}
    if (isset($_POST['history']))   {$history = $_POST['history'];   $history = trim(stripslashes(htmlspecialchars($history)));}
    if (isset($_POST['cross']))     {$cross = $_POST['cross'];       $cross = (int)abs($cross);}
    if (isset($_POST['sec']))       {$sec = $_POST['sec'];           $sec = (int)abs($sec);}

    $data= array();
    
    if(!preg_match('/1/', $answer)){unset($answer);}
    if(preg_match("/^[0-9:+-]+$/",$history)){$history = $history;}else{unset($history);}
    
    if(!$answer){
        $data['error_message'] .= '<div class="error">Поле кроссворда пустое, заполните его</div>'; $data['type'] = 1;
    }else{
        if(!$history){
            $data['error_message'] .= '<div class="error">Ошибка передачи данных истории!</div>'; $data['type'] = 1;
        }else{
            $selCross = mysqli_query($db, "SELECT otvet FROM dk_cross WHERE id='$cross' AND type='1' LIMIT 1");
            if(mysqli_num_rows($selCross) > 0){
                $resCross = mysqli_fetch_assoc($selCross);
                $solutionCross = $resCross['otvet'];
                $resClear = mysqli_query($db, "SELECT clear FROM solution WHERE id_cross='$cross' AND id_user='$selIdUser' LIMIT 1");
                if(mysqli_num_rows($resClear) > 0){
                    $myrClear = mysqli_fetch_assoc($resClear);
                    $clear =  $myrClear['clear'];
                    if($clear == 1){
                        $data['error_message'] .= '<div class="error">История уже сохранена<br>при положительном решении кроссворда.<br>Чтобы начать заново, очистите историю!</div>'; $data['type'] = 1; echo json_encode($data); exit();    
                    }  
                }
            }else{
                $data['error_message'] .= '<div class="error">Ошибка запроса. Попробуйте еще раз</div>'; $data['type'] = 1;
            }
        }
    }
    
    $procent = getAnswerProcent($answer, $solutionCross);
    
    if($answer and $cross and $sec and $history){
        if($selIdUser > 0){
            $date_clear_history = time() + 60 * 60 * 24 * 365;
            if(mysqli_query($db, "UPDATE solution SET history='$history',sec_history='$sec',date_clear_history='$date_clear_history' WHERE id_cross='$cross' AND id_user='$selIdUser'")){
                $data['error_message'] .= '<div class="error_plus">Кроссворд решен на: <strong>'.$procent.' %</strong>.<br>Решение сохранено!</div>'; $data['type'] = 2;   
            }else{
                $data['error_message'] .= '<div class="error">Ошибка запроса. Попробуйте еще раз</div>'; $data['type'] = 1;
            }
        }else{
            $data['error_message'] .= '<div class="error">Чтобы сохранить результат,<br>следует войти в личный кабинет, или зарегистрироваться.</div>'; $data['type'] = 1;
        }
    }
    
    echo json_encode($data);
?>