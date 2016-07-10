<?php

/**
 * @author kacevnik
 * @copyright 2016
 */

    define(HOST,"localhost");
    define(ADMIN_DB,"root");
    define(PASS_DB,"");
    define(NAME_DB,"cross");
    define(NAME_SITE,"Японские кроссворды");
    define(TITLE_SITE,"Samurai-ka.ru");
    define(ADMIN_EMAIL,"kacevnik@yandex.ru");
    define(DOMEN,"http://cross");
    define(IMG_CROSS, 'slim_cross.gif');
    define(TIMES,time());
    define(ENTER, '1');
    define(URLKA, $_SERVER['HTTP_REFERER']);
    define(IP_USER, $_SERVER['REMOTE_ADDR']);
    define(LIMIT, 10);//Количество кроссвордов на странице
    
    //Соединение с базой данных.
    
    $db = mysqli_connect(HOST,ADMIN_DB,PASS_DB);
    mysqli_query($db, "SET NAMES 'utf8'");         //Установка кодировки данных из базы.
    mysqli_select_db($db, NAME_DB) or die("Ощибка соединения с базой!");
    
    session_start();
    
    if(!$_SESSION['admin']){
        if($_COOKIE['LoginCookie']){
            $_SESSION['admin'] = $_COOKIE['LoginCookie'];
            header("Location: ".URLKA);
            exit();
        }
    }
    
    if(!isset($_COOKIE['numligth'])){
        setcookie('numligth','0',time()+60*60*24*300,"/");
    }
    
    if(!isset($_COOKIE['frame'])){
        setcookie('frame','0',time()+60*60*24*300,"/");
    }
    
    if(!isset($_COOKIE['scrolltop'])){
        setcookie('scrolltop','0',time()+60*60*24*300,"/");
    }

?>