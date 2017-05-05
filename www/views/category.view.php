                    <div class="content">
                        <h1><?=$dataCategory['name']?></h1>
                        <div class="list_cat">
                        <?php $count = $page * LIMIT_ART - LIMIT_ART + 1; foreach($getListArticles as $item){ ?>
                            <div class="list_cat_item">
                                <h3><a href="article.php?id=<?=$item["id"]?>"><?=$item["name"]?></a></h3>
                                <div class="list_cat_content">
                                <?=$item["prev"]?>
                                </div>
                                <div class="more"><a href="article.php?id=<?=$item["id"]?>">Подробнее...</a></div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="nav">
                            <ul>
<?php
    $id_cat_view = '&id='.$cat;
    if ($page != 1) $pervpage = '<li><a href=category.php?page=1'.$id_cat_view.'>Первая</a></li><li><a href=category.php?page='. ($page - 1) . $id_cat_view.'>Предыдущая</a></li>';
                
    if ($page != $total) $nextpage = '<li><a href=category.php?page='. ($page + 1) . $size_view.$power_view.'>Следующая</a></li><li><a href=category.php?page=' .$total. $id_cat_view.'>Последняя</a></li>';
                
    if($page - 3 > 0) $page3left = ' <li><a href=category.php?page='. ($page - 3) .$id_cat_view.'>'. ($page - 3) .'</a></li>';
    if($page - 2 > 0) $page2left = ' <li><a href=category.php?page='. ($page - 2) .$id_cat_view.'>'. ($page - 2) .'</a></li>';
    if($page - 1 > 0) $page1left = '<li><a href=category.php?page='. ($page - 1) .$id_cat_view.'>'. ($page - 1) .'</a></li>';
                
    if($page + 3 <= $total) $page3right = '<li><a href=category.php?page='. ($page + 3) .$id_cat_view.'>'. ($page + 3) .'</a></li>';
    if($page + 2 <= $total) $page2right = '<li><a href=category.php?page='. ($page + 2) .$id_cat_view.'>'. ($page + 2) .'</a></li>';
    if($page + 1 <= $total) $page1right = '<li><a href=category.php?page='. ($page + 1) .$id_cat_view.'>'. ($page + 1) .'</a></li>';
                             
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