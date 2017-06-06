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
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <?php include("views/top_include_css.view.php") ?>
    	<title>Подтверждение регистрации</title>
    </head>
    <body>
<?php include("views/top.view.php") ?>
<?php include("views/header.view.php") ?>
<?php include("views/left.view.php") ?>
<?php include("views/mes.view.php") ?>
<?php include("views/footer.view.php") ?>   
    </body>
</html>