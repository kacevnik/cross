<?php
    include("inc/core.php");
    
    if(isset($_GET['id']))$id = $_GET['id'];
    
    if(getCrossData($id))$crossData = getCrossData($id);
    $arr_top = strToArr($crossData[arr_top]);
    $arr_left = strToArr($crossData[arr_left]);
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="kacevnik" />
        <link rel="stylesheet" href="style/style.css" type="text/css">
        <link rel="stylesheet" href="style/font.css" type="text/css">
    	<title>Регистрация нового пользователя</title>
    </head>
    <body>
<?php include("views/top.view.php") ?>
<?php include("views/header.view.php") ?>
<?php include("views/left.view.php") ?>
<?php include("views/main_registr.view.php") ?>
<?php include("views/footer.view.php") ?>
    <script src="js/lib.js"></script>      
    </body>
</html>