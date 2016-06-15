<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    if($_SESSION["admin"]){
        $id_user = getIdFromSes($_SESSION['admin']);   
    }
    
    if(getListCross(10, $id_user)){$getListCross = getListCross(10, $id_user);}
?>