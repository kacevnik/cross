<?php
    include("inc/core.php");
    include("inc/article_const.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="kacevnik" />
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <?php include("views/top_include_css.view.php") ?>
        <meta name="keywords" content="<?=$articleData['meta_keys']?>">
        <meta name="description" content="<?=$articleData['dis']?>">
    	<title><?=$articleData['title']?></title>
    </head>
    <body>
<?php include("views/top.view.php") ?>
<?php include("views/header.view.php") ?>
<?php include("views/left.view.php") ?>
<?php include("views/article.view.php") ?>
<?php include("views/footer.view.php") ?>   
    </body>
</html>