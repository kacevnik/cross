<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    if (isset($_POST['submit']))    {$submit = $_POST['submit'];   $submit = trim(stripslashes(htmlspecialchars($submit)));}
    if (isset($_POST['email']))     {$email = $_POST['email'];     $email = trim(stripslashes(htmlspecialchars($email)));}
    if (isset($_POST['name']))      {$name = $_POST['name'];       $name = trim(stripslashes(htmlspecialchars($name)));}
    if (isset($_POST['text']))      {$text = $_POST['text'];       $text = trim(stripslashes(htmlspecialchars($text)));}

    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",$email)){unset($email);}else{$email = strtolower($email);}

    $capcha = $_POST['g-recaptcha-response'];
    $url_result = 'https://www.google.com/recaptcha/api/siteverify?secret=6LeafCIUAAAAAOKqQPXrTttDsuQx_MxvbBcV8Ctl&response='.$capcha.'&remoteip='.IP_USER;
    $back_capcha = json_decode(file_get_contents($url_result));

    if($submit){
        if($back_capcha->success == false){
            $_SESSION['error'] = '<div class="error">Подтвердите, что Вы не робот!</div>';
            header("Location: ans.php");
            exit(); 
        }
    }   

    if($submit){
        if($email){
            if($text){
                if($name){
                    mysqli_real_escape_string($db, $name);
                    mysqli_real_escape_string($db, $text);
                    mysqli_real_escape_string($db, $email);
				    $newUser = mysqli_query($db, "INSERT INTO dk_question (name,email,text,date_add,ip_user) VALUES ('$name','$email','$text','".TIMES."','".IP_USER."')");
                    $subject = "Сообщение на сайте ".TITLE_SITE;
                    $header = "From: \"".TITLE_SITE."\" <".ADMIN_EMAIL.">";
                    $message = "<h4>Здравствуйте, Адиминистратор</h4><p>С сайта отправлено сообщение.<br>От пользователя: ".$name."<br>E-mail: ".$email."<br>Текст сообщения: ".$text."</p><p>Данное письмо сгенерировано автоматически. Отвечать на него не надо.<br>Спасибо.</p>";
                    mail(ADMIN_EMAIL,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                    $_SESSION['error'] = "<div class='error_plus'>Спасибо. Ваше сообщение отправлено.</div>";
                    header("Location: ans.php");
                    exit();
                }
                else {$_SESSION['error'] = "<div class='error'>Заполните поле с сообщением!</div>";
                    header("Location: ans.php");
                    exit();
                }
            }
            else {$_SESSION['error'] = "<div class='error'>Не указано Имя!</div>";
                header("Location: ans.php");
                exit();
            }
       	}
    	else{$_SESSION['error'] = "<div class='error'>Поле E-mail не заполнено, или заполнено неправильно!</div>";
    	   header("Location: ans.php");
    	   exit();
        }
    }


?>