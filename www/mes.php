<?php
    include("inc/core.php");
    include("inc/mes_constructor.php");
    
    if(isset($_GET['id']))$id = $_GET['id'];
    
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="kacevnik" />
        <link rel="stylesheet" href="style/style.css" type="text/css">
        <link rel="stylesheet" href="style/font.css" type="text/css">
    	<title>Подтверждение регистрации</title>
    </head>
    <body>
<?php include("views/top.view.php") ?>
<?php include("views/header.view.php") ?>
<?php include("views/left.view.php") ?>
<?php include("views/mes.view.php") ?>
<?php include("views/footer.view.php") ?>
    <script src="js/lib.js"></script>      
    </body>
</html>