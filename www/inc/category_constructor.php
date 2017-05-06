<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    if($_SESSION["admin"]){
        $id_user = getIdFromSes($_SESSION['admin']);   
    }
    
    $page = 1;
    
    if(isset($_GET['id'])){$cat = $_GET['id']; $cat = (int)abs($cat);}
    if(!isset($cat)){header("Location: index.php");}
    
    if(isset($_GET['page'])){$page = $_GET['page']; if(!(int)abs($page)){$page = 1;}}
    
    if($page == 1 and isset($_GET['page'])){
        $arr = array('page=1&', '?page=1');
        header("Location: ".str_replace($arr, '', $_SERVER['REQUEST_URI']));
        exit();
    }
    
    $dataCategory = getDataCategory($cat);
    $count_page = $dataCategory['count'];

    $total = getTotalCategory($cat);
    $total = intval((($total - 1) / $count_page) + 1);
    if($page > $total){$page = $total;}
    
    if(getListArticles($cat, $count_page, $page)){$getListArticles = getListArticles($cat, $count_page, $page);}

?>