<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    if($_SESSION["admin"]){header("Location: lk.php"); exit();}
    
    if (isset($_POST['submit']))    {$submit = $_POST['submit'];   $submit = trim(stripslashes(htmlspecialchars($submit)));}
    if (isset($_POST['login']))     {$login = $_POST['login'];     $login = trim(stripslashes(htmlspecialchars($login)));}
    if (isset($_POST['pass']))      {$pass = $_POST['pass'];       $pass = trim(stripslashes(htmlspecialchars($pass)));}
    
    if (!preg_match("/^[a-z0-9]+[a-z0-9_-]{2,30}[a-z0-9]+$/i",$login)){unset($login);}else{$login = strtolower($login);}

    if (preg_match("/^[a-z0-9]{4,20}$/i",$pass)){$pass = $pass;}else{unset($pass);}    
	
    if($submit){
        if($login){
            if($pass){                                    
                $password = md5($pass);
                $sel = mysqli_query($db, "SELECT pass,kod,metka FROM dk_user WHERE login='$login' AND pass='$password'");
                if(mysqli_num_rows($sel) > 0){
                    $myr = mysqli_fetch_assoc($sel);
                    $metka = $myr["metka"];
                    $pass_md = $myr["pass"];
                    $kod = $myr["kod"];
                    if($metka == 1){
                        $_SESSION['admin'] = $pass_md.$kod;
                        setcookie('LoginCookie',$pass_md.$kod,time()+60*60*24*300,"/");
                        $_SESSION['error'] = "<div class='error_plus'>Добро пожаловать!</div>";
                        header("Location: lk.php");
                        exit();           
                    }
                    else{
                        $_SESSION['error'] = "<div class='error'>Данный аккаунт не активирован.</div>";
                        header("Location: login.php");
                        exit();
                    }    
                }
                else{
                    $_SESSION['error'] = "<div class='error'>Пользователя с такими данными не существует в базе!</div>";
                    header("Location: login.php");
                    exit();    
                }
            }
            else{
                $_SESSION['error'] = "<div class='error'>Заполните поле пароль правильно. Латинские символы и цифрыю.</div>";
                header("Location: login.php");
                exit();
            }
        }
        else{
            $_SESSION['error'] = "<div class='error'>Поле Логин не заполнено, или заполнено неправильно!</div>";
            header("Location: login.php");
            exit();
        }
    }
    
?>