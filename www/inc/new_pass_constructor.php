<?php 
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    if($_SESSION["admin"]){header("Location: lk.php"); exit();}
        
    if (isset($_GET['np']))       {$np = $_GET['np'];            $np = trim(stripslashes(htmlspecialchars($np)));}
    if (preg_match("/^[a-z0-9]{64,64}$/i",$np)){$np = $np;}else{unset($np);}
    
    if (isset($_POST['submit_new_pass']))   {$submit_new_pass = $_POST['submit_new_pass'];   $submit_new_pass = trim(stripslashes(htmlspecialchars($submit_new_pass)));}
    if (isset($_POST['email']))             {$email = $_POST['email'];                       $email = trim(stripslashes(htmlspecialchars($email)));}
    if (isset($_POST['capcha']))            {$capcha = $_POST['capcha'];                     $capcha = strtolower(trim(stripslashes(htmlspecialchars($capcha))));}
    
    if (isset($_POST['submit']))            {$submit = $_POST['submit'];                     $submit = trim(stripslashes(htmlspecialchars($submit)));}
    if (isset($_POST['pass']))              {$pass = $_POST['pass'];                         $pass = trim(stripslashes(htmlspecialchars($pass)));}
    if (isset($_POST['pass2']))             {$pass2 = $_POST['pass2'];                       $pass2 = trim(stripslashes(htmlspecialchars($pass2)));}
    
    if (preg_match("/^[a-z0-9]{4,20}$/i",$pass)){$pass = $pass;}else{unset($pass);}
    if (preg_match("/^[a-z0-9]{4,20}$/i",$pass2)){$pass2 = $pass2;}else{unset($pass2);}
    
    if (preg_match("/^[a-z0-9]{4,4}$/i",$capcha)){$capcha = $capcha;}else{unset($capcha);}
    
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",$email)){
        if(!preg_match("/^[a-z0-9]+[a-z0-9_-]{2,30}[a-z0-9]+$/i",$email)){
            unset($email);    
        }else{$email = strtolower($email); $flag = 1;}   
    }else{$email = strtolower($email); $flag = 2;}
	
    if($submit_new_pass){
        if($email){
            if($capcha == $_SESSION['capcha']){
                $resKodPoEmail = mysqli_query($db, "SELECT id,metka,pass,kod,login_view,email FROM dk_user WHERE email='$email' OR login='$email'");
                if(mysqli_num_rows($resKodPoEmail) > 0){
                    $myrKodPoEmail = mysqli_fetch_array($resKodPoEmail);
                    if($myrKodPoEmail['metka'] == 1){
                        $id = $myrKodPoEmail['id'];
                        $email = $myrKodPoEmail['email'];
                        $pass = $myrKodPoEmail['pass'];
                        $kod = $myrKodPoEmail['kod'];
                        $name = $myrKodPoEmail['login_view'];
                        $dateVosPass = time() + 86400;
                        $subject = "Восстановление пароля на сайте: ".TITLE_SITE;
                        $header = "From: \"".TITLE_SITE."\" <".ADMIN_EMAIL.">";
                        if($resDateVosPass = mysqli_query($db, "UPDATE dk_user SET date_up_pass='$dateVosPass' WHERE id='$id'")){
                            $message = "<h2 style='text-align: center'>Восстановление пароля</h2><p>Здравствуйте <b>".$name."</b></p><p>Для создания нового пароля для Вашего Аккаунта перейдите по ссылке:<br><a href='".DOMEN."/new_pass.php?np=".$pass.$kod."' target='blank'>Восстоновление пароля</a></p><p><b>Внимание ссылка действительна до: ".date("H:i d.m.Y",$dateVosPass)." (Сутки).</b></p><p>Пожалуйста, не отвечайте на это сообщение, оно было сгенерировано автоматически и только для информации.<br>Спасибо.</p>";
                            mail($email,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                            $_SESSION['error'] = "<div class='error_plus'>На Вашу почту отправлено письмо с инструкцией по восстановлению пароля. Спасибо.</div>";
                            header("Location: login.php");
                            exit();
                        }
                        else{
                            $_SESSION['error'] = "<p class='error'>Не правильный запрос, ссылка недействительна:(</p>";
                            header("Location: new_pass.php");
                            exit();                            
                        }       
                    }
                    else{
                        $_SESSION['error'] = "<p class='error'>Аккаунт не активирован</p>";
                        header("Location: new_pass.php");
                        exit();   
                    }
                }
                else{
                    if($flag == 1){$flag = "<p class='error'>Пользователь с Логином <i>".$email."</i> не зарегистрирован на сайте</p>";}else{
                        $flag = "<p class='error'>Пользователь с эл. почтой <i>".$email."</i> не зарегистрирован на сайте</p>";
                    }
                    $_SESSION['error'] = $flag; $flag = 0; 
                    header("Location: new_pass.php");
                    exit();   
                }
            }
            else{
                $_SESSION['error'] = "<p class='error'>Не верно введены символы с картинки!</p>";
                header("Location: new_pass.php");
                exit();
            }    
        }
        else{
            $_SESSION['error'] = "<p class='error'>Поле Email не заполнено, или заполнено некорректно</p>";
            header("Location: new_pass.php");
            exit();
        }
    }
    
    
    if($submit){
        if($np){
            $passProverka = substr($np, 0, 32);
            $kodProverka = substr($np, 32, 32);
            $resNewPass = mysqli_query($db, "SELECT date_up_pass,id FROM dk_user WHERE pass='$passProverka' AND kod='$kodProverka' AND metka='1'");
            if(mysqli_num_rows($resNewPass) > 0){
                $myrNewPass = mysqli_fetch_assoc($resNewPass);
                if(time() <= $myrNewPass["date_up_pass"]){
                    if($pass and $pass2){
                        if($pass == $pass2){
                        $id = $myrNewPass["id"];
                        $pass = md5($pass);
                        $kod =  md5(time());
                        if($resDateVosPass = mysqli_query($db, "UPDATE dk_user SET date_up_pass='0',pass='$pass',kod='$kod' WHERE id='$id'")){
                            $_SESSION['error'] = "<div class='error_plus'>Пароль изменен. Спасибо.</div>";
                            header("Location: new_pass.php");
                            exit();                            
                        }    
                    }
                    else{
                        $_SESSION['error'] = "<p class='error'>Пароли не совпадают</p>";
                        header("Location: new_pass.php?np=".$np);
                        exit();                        
                    }   
                }
                else{
                    $_SESSION['error'] = "<p class='error'>Не все поля заполены, Пароли только латиница и цифры</p>";
                    header("Location: new_pass.php?np=".$np);
                    exit();                    
                }    
            }
            else{
                $_SESSION['error'] = "<p class='error'>Не правильный запрос, Жизнь ссылки закончилась.</p>";
                header("Location: new_pass.php");
                exit();                 
            }
        }
        else{
            $_SESSION['error'] = "<p class='error'>Не правильный запрос, ссылка недействительна:(</p>";
            header("Location: new_pass.php");
            exit();            
        }    
    }
}
?>