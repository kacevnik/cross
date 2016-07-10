<?php
    if(isset($_GET['cross'])){$cross = $_GET['cross']; $cross = (int)abs($cross);}
    
    if(getCrossData($cross))$crossData = getCrossData($cross);else{header("Location: index.php"); exit();}
    
    $sec_history = 0;
    
    if($_SESSION['admin']){
        $idUser = getIdFromSes($_SESSION['admin']);
        $selSolution = mysqli_query($db, "SELECT sol_time_end,type,history,sec_history FROM solution WHERE id_user='$idUser' AND id_cross='$cross' LIMIT 1");
        if(mysqli_num_rows($selSolution) > 0){
            $res = mysqli_fetch_assoc($selSolution);
            if($res['type'] == 1){$showType = '<span class="icon-checkmark c_green"></span>';}
            if($res['sec_history'] > 0){
                $sec_history = $res['sec_history'];
                $history = $res['history'];
            }
        }
        else{
            $myr = mysqli_query($db,"INSERT INTO solution (sol_time_end,id_user,id_cross) VALUES ('".TIMES."','$idUser','$cross')");
        }
    }
       
    $top_string = strReplase($crossData[arr_top]);
    $left_string = strReplase($crossData[arr_left]);
    $arr_top = strToArr($top_string);
    $arr_left = strToArr($left_string);
        
    $arr_history = getArrayHistory($history);  
    
    if($_COOKIE['size']){$sess_size = $_COOKIE['size'];}else{$sess_size = 'cross_main';}
    if($_COOKIE['numligth']){$sess_numligth = 'checked=""';}else{$sess_numligth = '';}
    if($_COOKIE['frame']){$sess_frame = 'checked=""';}else{$sess_frame = '';}
    if($_COOKIE['lastnum']){$sess_lastnum = 'checked=""';}else{$sess_lastnum = '';}
    if($_COOKIE['showxy']){$sess_showxy = 'checked=""';}else{$sess_showxy = '';}
    if($_COOKIE['scrolltop']){$sess_scrolltop = 'checked=""';}else{$sess_scrolltop = '';}
?>