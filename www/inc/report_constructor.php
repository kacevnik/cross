<?php
    if(isset($_GET['cross'])){$cross = $_GET['cross']; $cross = (int)abs($cross);}
    
    if(getCrossData2($cross))$crossData = getCrossData2($cross);else{header("Location: index.php"); exit();}
    
    if($crossData['type'] == 1){$showType = '<span class="icon-checkmark c_green"></span>';}
    else{$showType = '';}
           

       
    $top_string = strReplase($crossData[arr_top]);
    $left_string = strReplase($crossData[arr_left]);
    $arr_top = strToArr($top_string);
    $arr_left = strToArr($left_string);
    
    $solution = str_split($crossData['otvet']);    
       
    if($_COOKIE['size']){$sess_size = $_COOKIE['size'];}else{$sess_size = 'cross_main';}
    if($_COOKIE['numligth']){$sess_numligth = 'checked=""';}else{$sess_numligth = '';}
    if($_COOKIE['frame']){$sess_frame = 'checked=""';}else{$sess_frame = '';}
    if($_COOKIE['lastnum']){$sess_lastnum = 'checked=""';}else{$sess_lastnum = '';}
    if($_COOKIE['showxy']){$sess_showxy = 'checked=""';}else{$sess_showxy = '';}
    if($_COOKIE['scrolltop']){$sess_scrolltop = 'checked=""';}else{$sess_scrolltop = '';}
?>