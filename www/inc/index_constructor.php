<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    if($_SESSION["admin"]){
        $id_user = getIdFromSes($_SESSION['admin']);   
    }
    
    $sizes = array('all', 'small', 'medium', 'big');
    $powers = array('all', 'simple', 'normal', 'hard');
    
    $page = 1;
    
    if(isset($_GET['page'])){$page = $_GET['page']; if(!(int)abs($page)){$page = 1;}}
    if($page == 1 and isset($_GET['page'])){
        header("Location: ".str_replace('page=1&', '', $_SERVER['REQUEST_URI']));
        exit();
    }
    
    if(isset($_GET['size'])){$size = $_GET['size']; if(in_array($size, $sizes)){$size = $size;}else{$size = 'all';}}else{$size = 'all';}
    if(isset($_GET['power'])){$power = $_GET['power']; if(in_array($power, $powers)){$power = $power;}else{$power = 'all';}}else{$power = 'all';}
    
    if(getListCross(LIMIT, getAllSize(), getAllPower(), $id_user, $page, $size, $power)){$getListCross = getListCross(LIMIT, getAllSize(), getAllPower(), $id_user, $page, $size, $power);}
    
    $total = array_pop($getListCross);
    $total = intval((($total - 1) / LIMIT) + 1);

?>