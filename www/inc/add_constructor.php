<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    if(!$_SESSION["admin"]){header("Location: login.php"); exit();}
?>