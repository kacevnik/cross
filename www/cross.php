<?php
    include("inc/core.php");
    include("inc/cross_constructor.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="kacevnik" />
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <link rel="stylesheet" href="style/style.css" type="text/css">
        <link rel="stylesheet" href="style/font.css" type="text/css">
        <meta name="keywords" content="японский кроссворд <?=$crossData['name']?>, японский кроссворд <?=$crossData['name']?> решать онлайн, японский кроссворд <?=$crossData['name']?> скачать">
        <meta name="description" content="На этой страинице вы можете решить онлайн или скачать себе на компьютер японский кроссворд <?=$crossData['name']?>">
    	<title>Японский кроссворд #<?php echo $crossData['id']." - ".$crossData['name']?></title>
        <script>
            var cnt = <?php echo $top = str_replace('n', '\'n\'', $top_string); ?>; 
            var cnl = <?php echo $left = str_replace('n', '\'n\'', $left_string); ?>;
        </script>
    </head>
    <body>
<?php include("views/top.view.php") ?>
<?php include("views/header.view.php") ?>
<?php include("views/left.view.php") ?>
<?php include("views/main.view.php") ?>
<?php include("views/footer.view.php") ?>
    <script src="js/jquery.js"></script>
    <script src="js/lib.js"></script>    
    <script src="js/script.js"></script>
    <?=$hello_message?>    
    </body>
</html>