<?php
    include("core.php");
    
    $selIdUser = 0;
    
    if($_SESSION["admin"]){
        $selIdUser = getIdFromSes($_SESSION['admin']);   
    }
    
        if (isset($_POST['cross']))       {$cross = $_POST['cross'];         $cross = (int)abs($cross);}
        if (isset($_POST['star']))        {$star = $_POST['star'];           $star = (int)abs($star);}
        if (isset($_POST['user']))        {$user = $_POST['user'];           $user = (int)abs($user);}
        $data= array();

        if($user != $selIdUser){
            $data['type'] = 1;
            $data['text'] = '<div class="error">Ошибка! Неверный пользователь!</div>';
            echo json_encode($data);
            exit;
        } 

        if($star > 5 || $star < 1){
            $data['type'] = 1;
            $data['text'] = '<div class="error">Ошибка! Неверное значение!</div>';
            echo json_encode($data);
            exit;
        }

        $sel = mysqli_query($db, "SELECT id FROM dk_stars WHERE id_user='$user' AND id_cross='$cross'");
        if(mysqli_num_rows($sel) > 0){
            $data['type'] = 1;
            $data['text'] = '<div class="error">Вы уже давали оценку этому кроссворду.</div>';
            echo json_encode($data);
            exit;
        }

        $ins = mysqli_query($db, "INSERT INTO dk_stars (id_user, id_cross, date_add, value) VALUES ('$user', '$cross', '".TIMES."', '$star')");
        $data['type'] = 1;
        $data['text'] = '<div class="error_plus">Спасибо!</div>';
    
    echo json_encode($data);