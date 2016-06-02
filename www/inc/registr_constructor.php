<?php

    if($_SESSION["admin"]){header("Location: lk.php"); exit();}
    
    if (isset($_POST['submit']))    {$submit = $_POST['submit'];   $submit = trim(stripslashes(htmlspecialchars($submit)));}
    if (isset($_POST['email']))     {$email = $_POST['email'];     $email = trim(stripslashes(htmlspecialchars($email)));}
    if (isset($_POST['pass']))      {$pass = $_POST['pass'];       $pass = trim(stripslashes(htmlspecialchars($pass)));}
    if (isset($_POST['pass2']))     {$pass2 = $_POST['pass2'];     $pass2 = trim(stripslashes(htmlspecialchars($pass2)));}
    if (isset($_POST['login']))     {$login = $_POST['login'];     $login = trim(stripslashes(htmlspecialchars($login)));}
    if (isset($_POST['capcha']))    {$capcha = $_POST['capcha'];   $capcha = trim(stripslashes(htmlspecialchars($capcha)));}

    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",$email)){unset($email);}else{$email = strtolower($email);}
    if (!preg_match("/^[a-z0-9]+[a-z0-9_-]{2,30}[a-z0-9]+$/i",$login)){unset($login);}else{$login_view = $login; $login = strtolower($login);}

    if (preg_match("/^[a-z0-9]{4,20}$/",$pass)){$pass = $pass;}else{unset($pass);}
    if (preg_match("/^[a-z0-9]{4,20}$/",$pass2)){$pass2 = $pass2;}else{unset($pass2);}    
    if (preg_match("/^[a-z0-9]{4}$/i",$capcha)){$capcha = strtolower($capcha);}else{unset($capcha);}    

    if($submit){
        if($email){
            $selEmailDb = mysqli_query($db, "SELECT id FROM dk_user WHERE email='$email'");
            if(mysqli_num_rows($selEmailDb) == 0){
                if($pass AND $pass2){
                    if($pass == $pass2){
                        if($login){
                            $selLoginDb = mysqli_query($db, "SELECT id FROM dk_user WHERE login='$login'");
                            if(mysqli_num_rows($selLoginDb) == 0){
                                if($capcha == $_SESSION["capcha"]){
                                    $password = md5($pass);
                                    $kod = md5(microtime());
               					    $newUser = mysqli_query($db, "INSERT INTO dk_user (login,login_view,email,pass,kod,time_add) VALUES ('$login','$login_view','$email','$password','$kod','".TIMES."')");
                                    $subject = "Подтверждение регистрации: ";
                                    $header = "From: \"".TITLE_SITE."\" <".ADMIN_EMAIL.">";
                                    $message = "<h4>Здравствуйте, поздравляем Вас с регистрацией на сайте ".TITLE_SITE."</h4><p>Ваш логин для входа: ".$login_view."<br>Ваш пароль: ".$pass."</p><p>Для подтверждения регистрации перейдите по ссылке:<br><a href='".DOMEN."/mes.php?u=".$password.$kod."'>Подтверждение регистрации</a></p><p>Данное письмо сгенерировано автоматически. Отвечать на него не надо.<br>Спасибо.</p>";
                                    mail($email,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                                    $_SESSION['error'] = "<div class='error_plus'>Пользователь добавлен. На указанную почту отправлено письмо с подстверждением регистрации.</div>";
                                    header("Location: registr.php");
                                    exit();
                                    }
                                    else {$_SESSION['error'] = "<div class='error'>Укажите проверочный код с картинки!</div>";
                                        header("Location: registr.php");
                                        exit();
                                    }
                                }
                                else {$_SESSION['error'] = "<div class='error'>Пользователь с таким логином уже зарегистрирован на сайте!</div>";
                                    header("Location: registr.php");
                                    exit();
                                }
                        }
                        else {$_SESSION['error'] = "<div class='error'>Не указан Логин</div>";
                            header("Location: registr.php");
                            exit();
                        }
                    }
        			else{$_SESSION['error'] = "<div class='error'>Пароли не совпадают!</div>";
                        header("Location: registr.php");
                        exit();
                    } 
         		}
        		else{$_SESSION['error'] = "<div class='error'>Заполните поля паролей правильно. Латинские символы и цифры</div>";
        		  header("Location: registr.php");
        		  exit();
                }
        	}
        	else{$_SESSION['error'] = "<div class='error'>Пользователь с таким E-mail уже зарегистрирован на сайте</div>";
        	   header("Location: registr.php");
        	   exit();
            }
       	}
    	else{$_SESSION['error'] = "<div class='error'>Поле E-mail не заполнено, или заполнено неправильно!</div>";
    	   header("Location: registr.php");
    	   exit();
        }
    }


?>