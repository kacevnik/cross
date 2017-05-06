<?php

/**
 * @author kacevnik
 * @copyright 2016
 */

    define(HOST,"localhost");
    define(ADMIN_DB,"joomlamix_cross");
    define(PASS_DB,"9564665");
    define(NAME_DB,"joomlamix_cross");
    define(NAME_SITE,"Японские кроссворды");
    define(TITLE_SITE,"Samurai-ka.ru");
    define(ADMIN_EMAIL,"admin@samurai-ka.ru");
    define(DOMEN,"http://samurai-ka.ru");
    define(IMG_CROSS, 'slim_cross.gif');
    define(TIMES,time());
    define(ENTER, '1');
    define(URLKA, $_SERVER['HTTP_REFERER']);
    define(IP_USER, $_SERVER['REMOTE_ADDR']);
    define(LIMIT, 10);//Количество кроссвордов на странице
    
    //Соединение с базой данных.
    
    $db = mysqli_connect(HOST,ADMIN_DB,PASS_DB);
    mysqli_query($db, "SET NAMES 'utf8'");         //Установка кодировки данных из базы.
    mysqli_select_db($db, NAME_DB) or die("Ошибка соединения с базой!");
    
    session_start();

?>