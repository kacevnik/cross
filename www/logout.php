<?php 
    include("inc/core.php");
    if(!$_SESSION["admin"]){
        header("Location: index.pnp");
        exit();
    }
    else{
        unset($_SESSION["admin"]);
        setcookie('LoginCookie',$pass_md.$kod,time()-1,"/");
        header("Location: ".URLKA);
        exit();
    }
?>