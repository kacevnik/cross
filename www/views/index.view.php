                    <div class="content">
                        <h1>Японские кроссворды</h1>
                        <div class="list_class_item">
                            <ul>
                            <?php foreach($getListCross as $item){ ?>
                                <li>
                                    <table>
                                        <tr>
                                            <td rowspan="4"><a href="cross.php?cross=<?=$item[id]?>"><img src="http://novostroiki-m.ru/images/18/p.jpg" /></a></td>
                                            <td  colspan="2"><h4><a href="cross.php?cross=">Кроссворд №23</a></h4></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><span class="icon-user"></span>Добавил: <strong><a href="user.php?id=<?=$crossData['user_add_id']?>"><?=getLoginName($crossData['user_add_id'])?></a></strong></td>
                                            <td><span class="icon-calendar"></span>Добавлен: <strong><?=getShotDate($crossData['time_add'])?></strong></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><span class="icon-star-full"></span>Рейтинг: <?=showStars($crossData['count_star'])?></td>
                                            <td><span class="icon-hour-glass"></span>Ср. скорость: <span class="cross_info_bold"><?=getCountSec($crossData['s_time']);?></span></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><span class="icon-trophy"></span>Сложность: <?=showStars($crossData['power'])?></td>
                                            <td><span class="icon-enlarge"></span>Размеры: 10x10</td>
                                        </tr>
                                    </table>
                                </li>
                                <?php } ?>
                                <li>
                                    <table>
                                        <tr>
                                            <td rowspan="3"><a href="cross.php?cross="><img src="http://novostroiki-m.ru/images/18/p.jpg" /></a></td>
                                            <td  colspan="2"><h4><a href="cross.php?cross=">Кроссворд №23</a></h4></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><span class="icon-star-full"></span>Рейтинг: <?=showStars($crossData['count_star'])?></td>
                                            <td><span class="icon-hour-glass"></span>Ср. скорость: <span class="cross_info_bold"><?=getCountSec($crossData['s_time']);?></span></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><span class="icon-trophy"></span>Сложность: <?=showStars($crossData['power'])?></td>
                                            <td><span class="icon-enlarge"></span>Размеры: 10x10</td>
                                        </tr>
                                    </table>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>