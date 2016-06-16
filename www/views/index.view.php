                    <div class="content">
                        <h1>Японские кроссворды</h1>
                        <div class="list_class_item">
                            <ul>
                            <?php foreach($getListCross as $item){ ?>
                                <li>
                                    <table>
                                        <tr>
                                            <td rowspan="4"><a href="cross.php?cross=<?=$item['id']?>"><img src="http://novostroiki-m.ru/images/18/p.jpg" /></a></td>
                                            <td  colspan="3"><h4><a href="cross.php?cross=<?=$item['id']?>">Кроссворд №<?=$item['id']?></a><?php if($item['type']){?><span class="icon-checkmark c_green"></span><em><?=$item['name']?></em><?php } ?></h4></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><span class="icon-user"></span>Добавил: <strong><a href="user.php?id=<?=$item['user_add_id']?>"><?=getLoginName($item['user_add_id'])?></a></strong></td>
                                            <td><span class="icon-calendar"></span>Добавлен: <strong><?=getShotDate($item['time_add'])?></strong></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><span class="icon-star-full"></span>Рейтинг: <?=showStars($item['count_star'])?></td>
                                            <td><span class="icon-hour-glass"></span>Ср. скорость: <strong><?=getCountSec($item['s_time']);?></strong></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><span class="icon-trophy"></span>Сложность: <?=showStars($item['power'])?></td>
                                            <td><span class="icon-enlarge"></span>Размеры: <?=$item['cross_w']?>x<?=$item['cross_h']?></td>
                                        </tr>
                                    </table>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>