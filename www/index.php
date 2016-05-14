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
    	<title>Японик</title>
    </head>
    <body>
    <div class="top">
        <div class="center">
            <div class="top-left">06 ноя 1982 Вт.</div>
                <ul class="login-top">
                    <li><a href="">Вход</a></li>
                    <li><a href="">Регистрация</a></li>
                </ul>
        </div>
    </div>
    <div class="header">
        <div class="center">
            <div class="header-logo">
                <a href="index.php"><img src="images/logo.png"></a>            
                <a href="index.php"><img src="images/logo-text.png"></a>            
            </div>
            <div class="line"></div>
        </div>
    </div>
    <div class="main">
        <div class="center">
            <div class="main-bg">
                <div class="left">
                    text
                </div>
                <div class="content">
                    <h1>Японский кроссворд № 1</h1>
                    <div class="cross_info">
                        <ul>
                            <li title="Этот японский кроссворд добавил Kacevnik"><span class="icon-user"></span>Добавил: <a href="">Kacevnik</a></li>
                            <li><span class="icon-calendar"></span>Добавлен: <span class="cross_info_bold">06 ноя 1982</span></li>
                        </ul>
                        <ul>
                            <li><span class="icon-star-full"></span>Рейтинг: <span class="icon-star-full c_orange"></span><span class="icon-star-full c_orange"></span><span class="icon-star-full c_orange"></span><span class="icon-star-half c_orange"></span><span class="icon-star-empty c_orange"></span></li>                                            
                            <li><span class="icon-trophy"></span>Сложность:<span class="icon-star-full c_orange"></span><span class="icon-star-full c_orange"></span><span class="icon-star-full c_orange"></span><span class="icon-star-half c_orange"></span><span class="icon-star-empty c_orange"></span></li>
                        </ul>
                        <ul>
                            <li><span class="icon-hour-glass"></span>Ср. скорость: <span class="cross_info_bold">1ч. 20 мин.</span></li>
                            <li><span class="icon-target"></span>Решили: <span class="cross_info_bold">12</span> раз</li>
                        </ul>
                    </div>
                    <table class="cross_main" oncontextmenu="return false;">
            <tbody>
                <tr>         
                    <td style="background: #f1f1f1; cursor: default;">&nbsp;</td>
                    <td>
                        <table>
                            <tbody>
                            <?php $count_tr_top = 0; $count_td_top = 0; foreach($arr_top as $item_top){
                                echo "<tr>";
                                foreach($item_top as $item_td_top){
                                    if(($count_td_top + 1)%5 == 0 && ($count_td_top + 1) != count($item_top)){$class_num_5 = ' td_str5';}else{$class_num_5 = '';}      
                            ?>
                                  <td <?php if($item_td_top[0] == 'n'){echo 'class="td_null"';}else{echo 'id="cnt'.$count_td_top.'_'.$count_tr_top.'" onmousedown="crossNumderTop(event, '.$count_td_top.', '.$count_tr_top.')" class="kletka'.$class_num_5.'"';} ?>>
                                    <div><?php if($item_td_top[0] == 'n'){echo '&nbsp;';}else{echo $item_td_top[0];} ?></div>
                                  </td>
                            <?php
                                     $count_td_top++;              
                                }
                                echo "</tr>";
                                $count_td_top = 0;
                                $count_tr_top++;  
                            }
                            ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tbody>
                                <?php 
                                    $count_tr_left = 0; $count_td_left = 0; foreach($arr_left as $item_left){ 
                                    if(($count_tr_left + 1)%5 == 0 && ($count_tr_left + 1) != count($arr_left)){$class_num_5 = ' class="tr_str5"';}else{$class_num_5 = '';}    
                                ?>
                                <tr<?php echo $class_num_5; ?>>
                                    <?php foreach($item_left as $item_td_left){ ?>
                                    <td <?php if($item_td_left[0] == 'n'){echo 'class="td_null"';}else{echo 'id="cnl'.$count_tr_left.'_'.$count_td_left.'" onmousedown="crossNumderLeft(event, '.$count_tr_left.', '.$count_td_left.')" class="kletka'.$class_num_5.'"';} ?>>
                                        <div><?php if($item_td_left[0] == 'n'){echo '&nbsp;';}else{echo $item_td_left[0];} ?></div>
                                    </td>
                                    <?php $count_td_left++; } ?>
                                </tr>
                                <?php $count_td_left = 0; $count_tr_left++; } ?>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tbody>
                                <?php 
                                    for($tr = 0; $tr < $crossData['cross_h']; $tr++){
                                        if(($tr + 1)%5 == 0 && ($tr + 1) != $crossData['cross_h']){$class_num_5 = ' class="tr_str5"';}else{$class_num_5 = '';}
                                ?>
                                <tr<?php echo $class_num_5; ?>>
                                    <?php 
                                        for($td = 0; $td < $crossData['cross_w']; $td++){ 
                                            if(($td + 1)%5 == 0 && ($td + 1) != $crossData['cross_w']){$class_num_5 = ' class="td_str5"';}else{$class_num_5 = '';}    
                                    ?>
                                    <td id="cma<?=$tr?>_<?=$td?>" onmousedown="crossPic(event, <?=$tr?>, <?=$td?>)" onmouseover="hoverCrossPic(event, <?=$tr?>, <?=$td?>)"<?php echo $class_num_5; ?>>
                                        <div>&nbsp;</div>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                
            </tbody>
        </table>
                `   <div class="seting">
                        <ul>
                            <li><a href="">Отменить (7)</a></li>
                            <li><a href="">Очистить</a></li>
                            <li><a href="">Увеличить ячейки</a></li>
                            <li><a href="">Уменьшить ячейки</a></li>
                            <li><a href="">Мобильная версия</a></li>
                        </ul>    
                    </div>
                </div>
            <div style="clear: both;"></div>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>    
    </body>
</html>