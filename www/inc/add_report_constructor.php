<?php
    include("core.php");
    
    if (isset($_POST['solution']))    {$solution = $_POST['solution'];   $solution = trim(stripslashes(htmlspecialchars($solution)));}
    if (isset($_POST['top']))         {$top = $_POST['top'];             $top = trim(stripslashes(htmlspecialchars($top)));}
    if (isset($_POST['left']))        {$left = $_POST['left'];           $left = trim(stripslashes(htmlspecialchars($left)));}
    if (isset($_POST['name']))        {$name = $_POST['name'];           $name = trim(stripslashes(htmlspecialchars($name)));}
    if (isset($_POST['cal_date']))    {$cal_date = $_POST['cal_date'];   $cal_date = trim(stripslashes(htmlspecialchars($cal_date)));}
    if (isset($_POST['h']))           {$h = $_POST['h'];                 $h = (int)abs($h);}
    if (isset($_POST['w']))           {$w = $_POST['w'];                 $w = (int)abs($w);}
    if (isset($_POST['cross']))       {$cross = $_POST['cross'];         $cross = (int)abs($cross);}
    if (isset($_POST['pass']))        {$pass = $_POST['pass'];           $pass = (int)abs($pass);}
    if (isset($_POST['show_date']))   {$show_date = $_POST['show_date']; $show_date = (int)abs($show_date);}
    if (isset($_POST['select_h']))    {$select_h = $_POST['select_h'];   $select_h = (int)abs($select_h);}
    if (isset($_POST['select_m']))    {$select_m = $_POST['select_m'];   $select_m = (int)abs($select_m);}
    
    if(!preg_match('/1/', $solution)){unset($solution);}
    if($name == ''){unset($name);}
    if(preg_match('/[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}/',$cal_date)){$cal_date = $cal_date;}else{unset($cal_date);}
    if($select_h < 0 or $select_h > 23){unset($select_h);}
    if($select_m < 0 or $select_m > 11){unset($select_m);}
    
    if($cal_date){
        $y = substr($cal_date, 0, 4);
        $m = substr($cal_date, 5, 2);
        $d = substr($cal_date, 8, 2);
    }

    if($cal_date and $select_h >=0 and $select_m >= 0){
        $date = mktime($select_h, $select_m * 5, 0, $m, $d, $y);    
    }
    else{echo "<div class='error'>Ошибка с формированием даты</div>"; exit();}
    
    if(!$h || !$w){echo "<div class='error'>Ошибка с высотой или шириной кроссворда</div>"; unset($w);}
    if(!$solution){echo "<div class='error'>Поле кроссворда пустое, заполните его</div>";}
    if(!$name){echo "<div class='error'>Укажите название кроссворда</div>";}
    if($pass != date("G").'9564'){unset($pass); echo "<div class='error'>Неверный пароль</div>";}
        
    if($name && $solution && $h && $w && $pass){
            mysqli_real_escape_string($db, $name);
            mysqli_real_escape_string($db, $top);
            mysqli_real_escape_string($db, $left);
            mysqli_real_escape_string($db, $solution);
            $date_add = date("Y-m-d");
                      
                if(mysqli_query($db, "UPDATE dk_cross SET type='1',otvet='$solution',arr_top='$top',arr_left='$left',name='$name',time_of_public='$date' WHERE id='$cross'")){
                creat_and_add_images($cross, true);
                creat_and_add_images($cross);
                creat_and_add_images_answer($cross);
                    echo "<div class='error_plus'>Кроссворд проверен, если были изменения, то они внесены</div>";
                }
    }
?>