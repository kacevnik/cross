<?php
    include("core.php");
    
    if(!$_SESSION["admin"]){echo "Ошибка запроса";}
    else{
        $passProverka = substr($_SESSION["admin"], 0, 32);
        $kodProverka = substr($_SESSION["admin"], 32, 32);    
    }
    
    if (isset($_POST['solution']))    {$solution = $_POST['solution'];   $solution = trim(stripslashes(htmlspecialchars($solution)));}
    if (isset($_POST['top']))         {$top = $_POST['top'];             $top = trim(stripslashes(htmlspecialchars($top)));}
    if (isset($_POST['left']))        {$left = $_POST['left'];           $left = trim(stripslashes(htmlspecialchars($left)));}
    if (isset($_POST['name']))        {$name = $_POST['name'];           $name = trim(stripslashes(htmlspecialchars($name)));}
    if (isset($_POST['h']))           {$h = $_POST['h'];                 $h = (int)abs($h);}
    if (isset($_POST['w']))           {$w = $_POST['w'];                 $w = (int)abs($w);}
    
    if(!preg_match('/1/', $solution)){unset($solution);}
    if($name == ''){unset($name);}
    
    if(!$h || !$w){echo "<div class='error'>Ошибка с высотой или шириной кроссворда</div>"; unset($w);}
    if(!$solution){echo "<div class='error'>Поле кроссворда пустое, заполните его</div>";}
    if(!$name){echo "<div class='error'>Укажите название кроссворда</div>";}
    
    if($name && $solution && $h && $w){
        $sel = mysqli_query($db, "SELECT id FROM dk_user WHERE pass='$passProverka' AND kod='$kodProverka'");
        if(mysqli_num_rows($sel) > 0){
            $res = mysqli_fetch_assoc($sel);
            $id = $res["id"];
            mysqli_real_escape_string($db, $name);
            mysqli_real_escape_string($db, $top);
            mysqli_real_escape_string($db, $left);
            mysqli_real_escape_string($db, $solution);
            $date_add = date("Y-m-d");
            
            $sel_proverka =  mysqli_query($db, "SELECT id FROM dk_cross WHERE otvet='$solution'");
            if(mysqli_num_rows($sel_proverka) == 0){            
                if(mysqli_query($db, "INSERT INTO dk_cross (name,user_add_id,date_add,time_add,cross_h,cross_w,arr_top,arr_left,otvet) VALUES ('$name','$id','$date_add','".TIMES."','$h','$w','$top','$left','$solution')")){
                    echo "<div class='error_plus'>Кроссворд добавлен, после проверки он появится на сайте</div>";
                }
            }else{echo "<div class='error'>Такой кроссворд уже есть в базе!</div>";}
        }
    }
?>