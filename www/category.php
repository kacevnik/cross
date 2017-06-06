<?php
    include("inc/core.php");
    include("inc/category_constructor.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="kacevnik" />
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <?php include("views/top_include_css.view.php") ?>
        <meta name="keywords" content="<?=$dataCategory['meta_k']?>">
        <meta name="description" content="<?=$dataCategory['meta_d']?>">
    	<title><?=$dataCategory['title']?></title>
    </head>
    <script>
       //http://mattweb.ru/moj-blog/javascript-jquery/item/107-js-skript-podtverzhdenie-zakrytiya-stranitsy 
    </script>
    <body>
<?php include("views/top.view.php") ?>
<?php include("views/header.view.php") ?>
<?php include("views/left.view.php") ?>
<?php include("views/category.view.php") ?>
<?php include("views/footer.view.php") ?>  
    </body>
</html>