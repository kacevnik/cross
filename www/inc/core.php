<?php

/**
 * @author kacevnik
 * @copyright 2016
 */

    include("config.php");
    date_default_timezone_set('Europe/Moscow');
    
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
    
    if(!isset($_COOKIE['number'])){
        setcookie('number','0',time()+60*60*24*300,"/");
    }
    
    
    include("function.php");
    include("constract_main.php");
    include("site_map_constructor.php");
    
    $MAIN_SETINGS = getMainSetings();

    clerarHistory();
    addListBestUser();
    getSiteMap($MAIN_SETINGS);
    
?>