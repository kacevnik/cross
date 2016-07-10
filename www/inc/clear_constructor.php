<?php
    include("core.php");
    
    $selIdUser = 0;
    
    if($_SESSION["admin"]){
        $selIdUser = getIdFromSes($_SESSION['admin']);   
    }
    
    if (isset($_POST['answer']))    {$answer = $_POST['answer'];   $answer = trim(stripslashes(htmlspecialchars($answer)));}
    if (isset($_POST['cross']))     {$cross = $_POST['cross'];     $cross = (int)abs($cross);}

    $data= array();
    
    if(!preg_match('/[1-2]/', $answer)){unset($answer);}
    if(!$answer){
        $data['error_message'] .= '<div class="error">Поле кроссворда итак пустое, куда дальше то?</div>'; $data['type'] = 1;
    }else{   
        $selCross = mysqli_query($db, "UPDATE solution SET history='',sec_history='0' WHERE id_cross='$cross' AND id_user='$selIdUser'");
        $data['type'] = 2;
    }
    
    echo json_encode($data);
?>