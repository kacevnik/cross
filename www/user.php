<?php
    include("inc/core.php");
    include("inc/user_constructor.php");
    
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="kacevnik" />
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <?php include("views/top_include_css.view.php") ?>
        <meta name="keywords" content="японские кроссворды">
        <meta name="description" content="Информационная страничка пользователя: <?=$login?> на сайте японских кроссвордов Samurai-ka.ru">
    	<title>Личный кабинет</title>
    </head>
    <body>
<?php include("views/top.view.php") ?>
<?php include("views/header.view.php") ?>
<?php include("views/left.view.php") ?>
<?php include("views/user.view.php") ?>
<?php include("views/footer.view.php") ?>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/user.js"></script>
    </body>
</html>