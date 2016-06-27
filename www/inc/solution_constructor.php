<?php
    include("core.php");
    
    $selIdUser = 0;
    
    if($_SESSION["admin"]){
        $selIdUser = getIdFromSes($_SESSION['admin']);   
    }
    
    if (isset($_POST['solution']))    {$solution = $_POST['solution'];   $solution = trim(stripslashes(htmlspecialchars($solution)));}
    if (isset($_POST['cross']))       {$cross = $_POST['cross'];         $cross = (int)abs($cross);}
    if (isset($_POST['sec']))         {$sec = $_POST['sec'];             $sec = (int)abs($sec);}
    
    if(!preg_match('/1/', $solution)){unset($solution);}
    if(!$solution){echo '<div class="error">Поле кроссворда пустое, заполните его<a href="" title="Закрыть сообщение" class="close_error"></a></div>';}
    
    $selCross = mysqli_query($db, "SELECT id,name,otvet,s_time FROM dk_cross WHERE id='$cross' AND type='1' LIMIT 1");
    if(mysqli_num_rows($selCross) > 0){
        $resCross = mysqli_fetch_assoc($selCross);
        $idCross = $resCross['id'];
        $nameCross = $resCross['name'];
        $solutionCross = $resCross['otvet'];
        $sTimenCross = $resCross['s_time'];
    }else{
        echo '<div class="error">Ошибка запроса. Попробуйте еще раз<a href="" title="Закрыть сообщение" class="close_error"></a></div>';
    }
    
    if($solutionCross != $solution){unset($solution); echo '<div class="error">Неверное решение. Где-то ошибка.<a href="" title="Закрыть сообщение" class="close_error"></a></div>';}
    
    if($solution && $cross && $selCross){
        
        $sel = mysqli_query($db, "SELECT id,sol_time_end,sol_time,type FROM solution WHERE id_user='$selIdUser' AND id_cross='$cross'");
        if(mysqli_num_rows($sel) > 0){
            $res = mysqli_fetch_assoc($sel);
            $idSolution = $res['id'];
            $solTime = $res['sol_time_end'];
            $sekTime = $res['sol_time'];
            $solType = $res['type'];
            if($sec > $sekTime && $sekTime != 0){$sec = $sekTime;}
            if((TIMES - $solTime) < $sec){
                echo '<div class="error">Ошибка запроса. Попробуйте еще раз<a href="" title="Закрыть сообщение" class="close_error"></a></div>';
            }else{
                $up = mysqli_query($db, "UPDATE solution SET sol_time='$sec',type='1' WHERE id='$idSolution'");
                $selMidleTime = mysqli_query($db, "SELECT AVG(sol_time) AS OrderTotal FROM solution WHERE id_cross='$cross'");
                $a = mysqli_fetch_assoc($selMidleTime);
                $a = floor($a['OrderTotal']);
                $up = mysqli_query($db, "UPDATE dk_cross SET s_time='$a' WHERE id='$cross'");
                
                $resMax = mysqli_query($db, "SELECT s_time FROM dk_cross ORDER BY s_time DESC LIMIT 1");
                $selMax = mysqli_fetch_assoc($resMax);
                $selMax = $a/($selMax['s_time']/10);
                $selMax2 = ceil($selMax);
                $up = mysqli_query($db, "UPDATE dk_cross SET power='$selMax2' WHERE id='$cross'");
                
                if($solType == 0){
                    $resReiting = mysqli_query($db, "SELECT reting FROM dk_user WHERE id='$selIdUser'");
                    $selReiting = mysqli_fetch_assoc($resReiting);
                    $reting = $selReiting['reting'];
                    $reting+=$selMax;
                    $up = mysqli_query($db, "UPDATE dk_user SET reting='$reting' WHERE id='$selIdUser'");
                }                
                echo "<div class='error_plus'>Поздравляем! Вы решили кроссворд - <strong>".$nameCross."</strong>";
            }
        }
        else{
            echo "<div class='error_plus'>Поздравляем! Вы решили кроссворд - <strong>".$nameCross."</strong><br>Чтобы сохранить результаты решения, зарегистрируйтесь на сайте или войдите в личный кабинет.</div>";
        }
    }
?>