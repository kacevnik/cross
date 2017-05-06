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
        <link rel="stylesheet" href="style/style.css" type="text/css">
        <link rel="stylesheet" href="style/font.css" type="text/css">
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
    </body>
</html>