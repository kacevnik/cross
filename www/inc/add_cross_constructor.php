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
    $data= array();
    
    if(!preg_match('/1/', $solution)){unset($solution);}
    if($name == ''){unset($name);}
    
    if(!$h || !$w){unset($w); $data['error_message'] .= '<div class="error">Ошибка с высотой или шириной кроссворда.</div>'; $data['type'] = 1;} 
    if(!$solution){$data['error_message'] .= '<div class="error">Поле кроссворда пустое, заполните его.</div>'; $data['type'] = 1;}
    if(!$name){$data['error_message'] .= '<div class="error">Укажите название кроссворда.</div>'; $data['type'] = 1;}
    
    if($name && $solution && $h && $w){
        $sel = mysqli_query($db, "SELECT id,login_view FROM dk_user WHERE pass='$passProverka' AND kod='$kodProverka'");
        if(mysqli_num_rows($sel) > 0){
            $res = mysqli_fetch_assoc($sel);
            $id = $res["id"];
            $login = $res["login_view"];
            mysqli_real_escape_string($db, $name);
            mysqli_real_escape_string($db, $top);
            mysqli_real_escape_string($db, $left);
            mysqli_real_escape_string($db, $solution);
            $date_add = date("Y-m-d");
            $size = $h * $w;
            
            $sel_proverka =  mysqli_query($db, "SELECT id FROM dk_cross WHERE otvet='$solution'");
            if(mysqli_num_rows($sel_proverka) == 0){            
                if(mysqli_query($db, "INSERT INTO dk_cross (name,user_add_id,date_add,time_add,cross_h,cross_w,arr_top,arr_left,otvet,size) VALUES ('$name','$id','$date_add','".TIMES."','$h','$w','$top','$left','$solution','$size')")){
                    $last_id = mysqli_insert_id($db);
                    $subject = "Новый кроссворд на сайте: ";
                    $header = "From: \"".TITLE_SITE."\" <".ADMIN_EMAIL.">";
                    $message = "<h4>Здравствуйте, администратор!</h4><p>Пользователь <a href='".DOMEN."/user.php?id=".$id."' target='blank'>".$login."</a> добавил новый кроссворд с названием: <strong>".$name."</strong>. Для проверки кроссворда следует перейти по ссылке:<br><a href='".DOMEN."/report.php?cross=".$last_id."' target='blank'>Проверка кроссворда</a></p><p>Данное письмо сгенерировано автоматически. Отвечать на него не надо.<br>Спасибо.</p>";
                    mail(ADMIN_EMAIL,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                    $data['error_message'] .= '<div class="error_plus">Кроссворд добавлен, после проверки он появится на сайте.</div>'; $data['type'] = 1;
                }
            }else{$data['error_message'] .= '<div class="error">Такой кроссворд уже есть в базе!</div>'; $data['type'] = 1;}
        }
    }
    echo json_encode($data);
?>