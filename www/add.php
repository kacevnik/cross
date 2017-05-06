<?php
    include("inc/core.php");
    include("inc/add_constructor.php");
    
    if(isset($_GET['id']))$id = $_GET['id'];
    
    if(getCrossData($id))$crossData = getCrossData($id);
    $arr_top = strToArr($crossData[arr_top]);
    $arr_left = strToArr($crossData[arr_left]);
       
    if($_COOKIE['size']){$sess_size = $_COOKIE['size'];}else{$sess_size = 'cross_main';}
    if($_COOKIE['numligth']){$sess_numligth = 'checked=""';}else{$sess_numligth = '';}
    if($_COOKIE['frame']){$sess_frame = 'checked=""';}else{$sess_frame = '';}
    if($_COOKIE['lastnum']){$sess_lastnum = 'checked=""';}else{$sess_lastnum = '';}
    if($_COOKIE['showxy']){$sess_showxy = 'checked=""';}else{$sess_showxy = '';}
    if($_COOKIE['scrolltop']){$sess_scrolltop = 'checked=""';}else{$sess_scrolltop = '';}
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="kacevnik" />
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <link rel="stylesheet" href="style/style.css" type="text/css">
        <link rel="stylesheet" href="style/font.css" type="text/css">
    	<title>Добавить новый кроссворд</title>
    </head>
    <body>
<?php include("views/top.view.php") ?>
<?php include("views/header.view.php") ?>
<?php include("views/left.view.php") ?>
<?php include("views/add.view.php") ?>
<?php include("views/footer.view.php") ?>
    <script src="js/jquery.js"></script>    
    <script src="js/lib.js"></script>    
    <script src="js/script_add.js"></script>    
    </body>
</html>