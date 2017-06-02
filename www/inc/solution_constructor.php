<?php
    include("core.php");
    
    $selIdUser = 0;
    
    if($_SESSION["admin"]){
        $selIdUser = getIdFromSes($_SESSION['admin']);   
    }
    
    if (isset($_POST['solution']))    {$solution = $_POST['solution'];   $solution = trim(stripslashes(htmlspecialchars($solution)));}
    if (isset($_POST['history']))     {$history = $_POST['history'];     $history = trim(stripslashes(htmlspecialchars($history)));}
    if (isset($_POST['cross']))       {$cross = $_POST['cross'];         $cross = (int)abs($cross);}
    if (isset($_POST['sec']))         {$sec = $_POST['sec'];             $sec = (int)abs($sec);}
    $data= array();

    if(!preg_match('/1/', $solution)){unset($solution);}
    if(preg_match("/^[0-9:+-]+$/",$history)){$history = $history;}else{unset($history);}
    if($history){
        $new_array_history = array();
        $small_history = explode(':', $history);
        $array_first = array_shift($small_history);
        $array_last = array_pop($small_history);
        if(count($small_history) > 30){
            $count = count($small_history) / 30;
            $sum_count = $count;
            $new_array_history[] = $array_first; 
            for($ai = 0; $ai < 29; $ai++){
                $new_array_history[] = $small_history[floor($sum_count)];
                $sum_count = $sum_count + $count;
            }
            $new_array_history[] = $array_last;
        }
        else{
            $new_array_history = $small_history;
            array_unshift($new_array_history, $array_first);
            array_push($new_array_history, $array_last);
        }
        $string = implode(':', $new_array_history);
    }

    $sec_reiting = $sec;

    if(!$solution){$data['error_message'] .= '<div class="error">Поле кроссворда пустое, заполните его</div>'; $data['type'] = 1; 
    echo json_encode($data); exit();}
    if(!$history){$data['error_message'] .= '<div class="error">Ошибка запроса данных истории!</div>'; $data['type'] = 1; 
    echo json_encode($data); exit();}
    
    $selCross = mysqli_query($db, "SELECT id,name,otvet,s_time,size FROM dk_cross WHERE id='$cross' AND type='1' LIMIT 1");
    if(mysqli_num_rows($selCross) > 0){
        $resCross = mysqli_fetch_assoc($selCross);
        $idCross = $resCross['id'];
        $nameCross = $resCross['name'];
        $solutionCross = $resCross['otvet'];
        $size = $resCross['size'];
        $sTimenCross = $resCross['s_time'];
    }else{
        $data['error_message'] .= '<div class="error">Ошибка запроса. Попробуйте еще раз</div>'; $data['type'] = 1;
    }
    
    if($solutionCross != $solution){unset($solution); $data['error_message'] .= '<div class="error">Неверное решение. Где-то ошибка.</div>'; $data['type'] = 1;}
    
    if($solution && $cross && $selCross && $history){
        
        $sel = mysqli_query($db, "SELECT id,sol_time,type FROM solution WHERE id_user='$selIdUser' AND id_cross='$cross'");
        if(mysqli_num_rows($sel) > 0){
            $res = mysqli_fetch_assoc($sel);
            $idSolution = $res['id'];
            $sekTime = $res['sol_time'];
            $solType = $res['type'];
            $date_clear_history = TIMES + 60 * 60 * 24 * 365; //1 Год
            if($sec > $sekTime && $sekTime != 0){$sec = $sekTime;}
                $up = mysqli_query($db, "UPDATE solution SET sol_time='$sec',type='1',history='$string',sec_history='$sec',clear='1',date_clear_history='$date_clear_history' WHERE id='$idSolution'");
                $selMidleTime = mysqli_query($db, "SELECT AVG(sol_time) AS OrderTotal FROM solution WHERE id_cross='$cross'");
                $a = mysqli_fetch_assoc($selMidleTime);
                $a = floor($a['OrderTotal']);
                if($a == 0){$a = $sec;}
                $up = mysqli_query($db, "UPDATE dk_cross SET s_time='$a' WHERE id='$cross'");
                
                $resMax = mysqli_query($db, "SELECT s_time FROM dk_cross ORDER BY s_time DESC LIMIT 1");
                $selMax = mysqli_fetch_assoc($resMax);
                $selMax = $a/($selMax['s_time']/10);
                $selMax2 = ceil($selMax);
                $up = mysqli_query($db, "UPDATE dk_cross SET power='$selMax2' WHERE id='$cross'");

                //Вычисление и добавление в БД наибольшего рейтинга за решение кроссворда
                $reiting_full = $size/10/$sec_reiting*10;
                $res_reiting_full = mysqli_query($db, "SELECT * FROM dk_reiting_plus WHERE id_user='$selIdUser' AND id_cross='$cross' AND type = '0'");
                if(mysqli_num_rows($res_reiting_full) > 0){
                    $sel_reiting_full = mysqli_fetch_assoc($res_reiting_full);
                    $mar_reiting_full = $sel_reiting_full['reiting'];
                    $id_reiting_full  = $sel_reiting_full['id'];
                    if($mar_reiting_full < $reiting_full){
                        $res_reiting_user = mysqli_query($db, "SELECT reting FROM dk_user WHERE id='$selIdUser'");
                        $sel_reiting_user = mysqli_fetch_assoc($res_reiting_user);
                        $myr_reiting = $sel_reiting_user['reting'];
                        $new_user_reiting = $myr_reiting - $mar_reiting_full + $reiting_full;

                        $up = mysqli_query($db, "UPDATE dk_user SET reting='$new_user_reiting' WHERE id='$selIdUser'");

                        $up = mysqli_query($db, "UPDATE dk_reiting_plus SET reiting='$reiting_full', date_add='".TIMES."' WHERE id='$id_reiting_full'");
                    }

                }else{
                    $res_reiting_user = mysqli_query($db, "SELECT reting FROM dk_user WHERE id='$selIdUser'");
                    $sel_reiting_user = mysqli_fetch_assoc($res_reiting_user);
                    $myr_reiting = $sel_reiting_user['reting'];
                    $new_user_reiting = $myr_reiting + $reiting_full;

                    $up = mysqli_query($db, "UPDATE dk_user SET reting='$new_user_reiting' WHERE id='$selIdUser'");

                    $ins = mysqli_query($db, "INSERT INTO dk_reiting_plus (id_user, id_user_add, id_cross, date_add, reiting, type) VALUES ('$selIdUser', '$selIdUser', '$cross', '".TIMES."', '$reiting_full', '0')");
                }  
                //Вычисление и добавление в БД наибольшего рейтинга хозяину кроссворда за решение кроссворда
                $reiting_gift = $reiting_full/100*20;
                $res_reiting_full_gift = mysqli_query($db, "SELECT * FROM dk_reiting_plus WHERE id_user='$selIdUser' AND id_cross='$cross' AND type = '1'");
                if(mysqli_num_rows($res_reiting_full_gift) > 0){
                    $sel_reiting_full_gift = mysqli_fetch_assoc($res_reiting_full_gift);
                    $id_cross_gift = $sel_reiting_full_gift['id_cross'];
                    $id_raiting_gift = $sel_reiting_full_gift['id'];
                    $myr_raiting_gift = $sel_reiting_full_gift['reiting'];
                    $res_id_user_gift = mysqli_query($db, "SELECT user_add_id FROM dk_cross WHERE id='$cross'");
                    $sel_id_user_gift = mysqli_fetch_assoc($res_id_user_gift);
                    $myr_id_user_gift = $sel_id_user_gift['user_add_id'];
                    if($reiting_gift > $myr_raiting_gift){
                        $res_reiting_user_gift_new = mysqli_query($db, "SELECT reting FROM dk_user WHERE id='$myr_id_user_gift'");
                        $sel_reiting_user_gift_new  = mysqli_fetch_assoc($res_reiting_user_gift_new );
                        $myr_reiting_user_gift_new = $sel_reiting_user_gift_new['reting'];
                        $new_user_reiting_gift = $myr_reiting_user_gift_new - $myr_raiting_gift + $reiting_gift;

                        $up = mysqli_query($db, "UPDATE dk_reiting_plus SET reiting='$reiting_gift', date_add='".TIMES."' WHERE id='$id_raiting_gift'");

                        $up = mysqli_query($db, "UPDATE dk_user SET reting='$new_user_reiting_gift' WHERE id='$selIdUser'");
                    }
                }else{
                    $res_id_user_gift = mysqli_query($db, "SELECT user_add_id FROM dk_cross WHERE id='$cross'");
                    $sel_id_user_gift = mysqli_fetch_assoc($res_id_user_gift);
                    $myr_id_user_gift = $sel_id_user_gift['user_add_id'];

                    $res_reiting_user_gift_new = mysqli_query($db, "SELECT reting FROM dk_user WHERE id='$myr_id_user_gift'");
                    $sel_reiting_user_gift_new  = mysqli_fetch_assoc($res_reiting_user_gift_new );
                    $myr_reiting_user_gift_new = $sel_reiting_user_gift_new['reting'];
                    $new_user_reiting_gift = $myr_reiting_user_gift_new + $reiting_gift;

                    $ins = mysqli_query($db, "INSERT INTO dk_reiting_plus (id_user, id_user_add, id_cross, date_add, reiting, type) VALUES ('$selIdUser', '$myr_id_user_gift', '$cross', '".TIMES."', '$reiting_gift', '1')");

                    $up = mysqli_query($db, "UPDATE dk_user SET reting='$new_user_reiting_gift' WHERE id='$selIdUser'");
                }

                $data['error_message'] .= "<div class='error_plus'>Поздравляем! Вы решили кроссворд - <strong>".$nameCross."</strong>"; $data['type'] = 2;
        }
        else{
            if(isset($_COOKIE['sol'])){
                if(strpos($_COOKIE['sol'], $cross.'-') !== false){
                    $coocie_arr = explode($cross.'-', $_COOKIE['sol']);
                    $coocie_arr2 = explode('_', $coocie_arr[1]);
                    if($coocie_arr2[0] > $sec){
                        $cookie_sec = rtrim($coocie_arr[0].$cross.'-'.$sec.'_'.$coocie_arr2[1], '_');
                        setcookie('sol', $cookie_sec, time()+60*60*24*300,"/");
                    }
                }else{
                    $cookie_sec = ltrim($_COOKIE['sol'].'_'.$cross.'-'.$sec, '_');
                    setcookie('sol', $cookie_sec, time()+60*60*24*300,"/");
                }
            }
            else{
                $cookie_sec = $cross.'-'.$sec;
                setcookie('sol', $cookie_sec, time()+60*60*24*300,"/");
            }
            $data['error_message'] .= "<div class='error_plus'>Поздравляем! Вы решили кроссворд - <strong>".$nameCross."</strong><br>Чтобы сохранять результаты решения, зарегистрируйтесь на сайте или войдите в личный кабинет.</div>"; $data['type'] = 2;
        }
    }
    
    echo json_encode($data);