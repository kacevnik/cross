<?php
    include("core.php");
    
    $selIdUser = 0;
    
    if($_SESSION["admin"]){
        $selIdUser = getIdFromSes($_SESSION['admin']);   
    }
    
    if (isset($_POST['answer']))    {$answer = $_POST['answer'];   $answer = trim(stripslashes(htmlspecialchars($answer)));}
    if (isset($_POST['cross']))     {$cross = $_POST['cross'];     $cross = (int)abs($cross);}

    $data= array();
    
    if(!preg_match('/1/', $answer)){unset($answer);}
    if(!$answer){$data['error_message'] .= '<div class="error">Поле кроссворда пустое, заполните его</div>'; $data['type'] = 1;}
    
    $selCross = mysqli_query($db, "SELECT otvet,img FROM dk_cross WHERE id='$cross' AND type='1' LIMIT 1");
    if(mysqli_num_rows($selCross) > 0){
        $resCross = mysqli_fetch_assoc($selCross);
        $solutionCross = $resCross['otvet'];
        $imgCross = $resCross['img'];
    }else{
        $data['error_message'] .= '<div class="error">Ошибка запроса. Попробуйте еще раз</div>'; $data['type'] = 1;
    }
    
    $procent = getAnswerProcent($answer, $solutionCross);
    
    if($procent >= 50){
        $data['error_message'] .= '<img src="img_cross/'.$imgCross.'_ans.jpg">';$data['type'] = 2;
        $size = getimagesize("../img_cross/".$imgCross."_ans.jpg");
        $data['width_img'] = $size[0];
        $data['height_img'] = $size[1];
    }else{
        $data['error_message'] .= '<div class="error">Чтобы посмотреть ответ, <br>нужно решить кроссворд на 50% и более.<br>Сейчас :<strong>'.$procent.' %</strong></div>'; $data['type'] = 1;   
    }
    
    echo json_encode($data);
?>