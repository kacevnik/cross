<?php 
    include("inc/core.php");
    if(!$_SESSION["admin"]){
        header("Location: index.pnp");
        exit();
    }
    else{
        unset($_SESSION["admin"]);
        setcookie('hello_message','hello',time()+60*60*24*3,"/");
        setcookie('LoginCookie',$pass_md.$kod,time()-1,"/");
        header("Location: ".URLKA);
        exit();
    }
?>