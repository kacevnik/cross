<?php
    include("inc/core.php");
    include("inc/index_constructor.php");
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html" />
        <meta name="author" content="kacevnik" />
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <?php include("views/top_include_css.view.php") ?>
        <meta name="keywords" content="<?=$articleMainData['meta_keys']?>">
        <meta name="description" content="<?=$articleMainData['dis']?>">
        <title><?=$articleMainData['title']?></title>
    </head>
    <script>
       //http://mattweb.ru/moj-blog/javascript-jquery/item/107-js-skript-podtverzhdenie-zakrytiya-stranitsy 
    </script>
    <body>
<?php include("views/top.view.php") ?>
<?php include("views/header.view.php") ?>
<?php include("views/left.view.php") ?>
<?php include("views/index.view.php") ?>
<?php include("views/footer.view.php") ?>  
    </body>
</html>