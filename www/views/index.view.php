                    <div class="content">
<?php
    echo $_SESSION['error'];
    unset($_SESSION['error']); 
?>
                        <h1>Японские кроссворды</h1>
                        <div class="list_class_item">
                            <table>
                                <tbody>
                                <?php $count = $page * LIMIT - LIMIT + 1; foreach($getListCross as $item){ ?>
                                    <tr>
                                        <td class="box_number"><?=$count?></td>
                                        <td class="box_img"><a href="cross.php?cross=<?=$item['id']?>"><img src="img_cross/<?php if($item['type']){echo $item['img'];}else{echo $item['id'];}?>.jpg"/></a></td>
                                        <td class="box_data">
                                            <h4><a href="cross.php?cross=<?=$item['id']?>">Кроссворд №<?=$item['id']?></a><?php if($item['type']){?><span class="icon-checkmark c_green"></span><em><?=$item['name']?></em><?php } ?></h4>
                                            <table class="box_data_table">
                                                <tbody>
                                                    <tr>
                                                        <td><span class="icon-user"></span>Добавил:</td>
                                                        <td><a href="user.php?id=<?=$item['user_add_id']?>"><?=getLoginName($item['user_add_id'])?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="icon-enlarge"></span>Размеры: </td>
                                                        <td><?=$item['cross_w']?>x<?=$item['cross_h']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="icon-hour-glass"></span>Ср. скорость:</td>
                                                        <td><?=getCountSec($item['s_time']);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="icon-trophy"></span>Сложность:</td>
                                                        <td><?=showStars($item['power'])?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="icon-star-full"></span>Рейтинг:</td>
                                                        <td><?=showStars(getReitingStarCross($item['id']))?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr class="box_line">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                 <?php $count++;} ?>   
                                </tbody>
                            </table>
                        </div>
                        <div class="nav">
                            <ul>
<?php

    if($size != 'all'){$size_view = '&size='.$size;}
    if($power != 'all'){$power_view = '&power='.$power;}
    if ($page != 1) $pervpage = '<li><a href=index.php?page=1'.$size_view.$power_view.'>Первая</a></li><li><a href=index.php?page='. ($page - 1) . $size_view.$power_view.'>Предыдущая</a></li>';
                
    if ($page != $total) $nextpage = '<li><a href=index.php?page='. ($page + 1) . $size_view.$power_view.'>Следующая</a></li><li><a href=index.php?page=' .$total. $size_view.$power_view.'>Последняя</a></li>';
                
    if($page - 3 > 0) $page3left = ' <li><a href=index.php?page='. ($page - 3) .$size_view.$power_view.'>'. ($page - 3) .'</a></li>';
    if($page - 2 > 0) $page2left = ' <li><a href=index.php?page='. ($page - 2) .$size_view.$power_view.'>'. ($page - 2) .'</a></li>';
    if($page - 1 > 0) $page1left = '<li><a href=index.php?page='. ($page - 1) .$size_view.$power_view.'>'. ($page - 1) .'</a></li>';
                
    if($page + 3 <= $total) $page3right = '<li><a href=index.php?page='. ($page + 3) .$size_view.$power_view.'>'. ($page + 3) .'</a></li>';
    if($page + 2 <= $total) $page2right = '<li><a href=index.php?page='. ($page + 2) .$size_view.$power_view.'>'. ($page + 2) .'</a></li>';
    if($page + 1 <= $total) $page1right = '<li><a href=index.php?page='. ($page + 1) .$size_view.$power_view.'>'. ($page + 1) .'</a></li>';
                             
    if ($total > 1){
        Error_Reporting(E_ALL & ~E_NOTICE);
                
        echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a  class='active_nav'>".$page.'</a></li>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
    }
?>

                            </ul>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>