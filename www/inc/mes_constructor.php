<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    if (isset($_GET['u']))    {$u = $_GET['u'];   $u = trim(stripslashes(htmlspecialchars($u)));}
    if (preg_match("/^[a-z0-9]{64,64}$/i",$u)){$u = $u;}else{unset($u);}
    
    if($u){
        $pass = substr($u, 0, 32);
        $kod  = substr($u, 32, 32);
        $res = mysqli_query($db, "SELECT id,login_view,email,metka FROM dk_user WHERE pass='$pass' AND kod='$kod'");
        if(mysqli_num_rows($res) > 0){
            $myr = mysqli_fetch_assoc($res);
            $metka = $myr["metka"];
            $id = $myr["id"];
            $login = $myr["login_view"];
            $email = $myr["email"];
            if($metka == 0){
                $up = mysqli_query($db, "UPDATE dk_user SET metka='1' WHERE id='$id'");
                $subject = "Новый пользователь подтвердил регистрацию: ";
                $header = "From: \"".TITLE_SITE."\" <".ADMIN_EMAIL.">";
                $message = "<p>Здравствуйте<br>На сайте новый пользователь подтвердил регистрацию.</p><p>Логин : <b>".$login."</b><br>E-mail: <b>".$email."</p><p>Данное письмо сгенерировано автоматически. Отвечать на него не надо.<br>Спасибо.</p>";
                mail(ADMIN_EMAIL,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n"); 
                
                $_SESSION['error'] = "<div class='error_plus'>Поздравляем, Вы подтвердили регистрацию и теперь можете войти в личный кабинет.</div>";
                header("Location: mes.php");
                exit();    
            }
            else{
                $_SESSION['error'] = "<div class='error'>Этот аккаунт уже активирован!</div>";
                header("Location: mes.php");
                exit();    
            }
        }
        else{
            $_SESSION['error'] = "<div class='error'>Ошибка запроса!</div>";
            header("Location: mes.php");
            exit();    
        }   
    }
?>