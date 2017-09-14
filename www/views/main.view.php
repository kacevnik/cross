                    <div class="content">
                    <div id="info_count_item" onmouseover="hoverFrame(event)"><?=$sess_show_number_data?></div>
                        <h1>Японский кроссворд № <?php echo $crossData['id']." &#171;".$crossData['name']."&#187;".$showType?></h1>
                        <table class="table_info_cross">
                            <tbody>
                                <tr>
                                    <td title="Этот японский кроссворд добавил><?=getLoginName($crossData['user_add_id'])?>"><span class="icon-user"></span>Добавил: </td>
                                    <td><a href="user.php?id=<?=$crossData['user_add_id']?>"><?=getLoginName($crossData['user_add_id'])?></a></td>
                                    <td><span class="icon-star-full"></span>Рейтинг:</td>
                                    <td><?=showStars(getReitingStarCross($crossData['id']))?></td>
                                    <td><span class="icon-hour-glass"></span>Ср. скорость:</td>
                                    <td><span class="cross_info_bold"><?=getCountSec($crossData['s_time']);?></span></td>
                                    <td rowspan="3"><div id="sec_history" style="display: none;"><?=$sec_history?></div><span id="timer"><?=getCountSecTimer($sec_history)?></span></span></td>
                                </tr>
                                <tr>
                                    <td><span class="icon-calendar"></span>Добавлен:</td>
                                    <td><span class="cross_info_bold"><?=getShotDate($crossData['time_add'])?></span></td>
                                    <td><span class="icon-trophy"></span>Сложность:</td>
                                    <td><?=showStars($crossData['power'])?></td>
                                    <td><?php if(bestTime($cross)){$bestTime = bestTime($cross); ?><span class="icon-power" title="<?=getCountSec($bestTime[1])?>"></span>Рекорд:</td>
                                    <td><a href="user.php?id=<?=$bestTime[0]?>"><?=getLoginName($bestTime[0])?></a><?=getCountSec($bestTime[1])?><?php } ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><span class="icon-target"></span>Решили:</td>
                                    <td><span class="cross_info_bold"><?=getCountSolution($cross)?></span> р<?php echo numberEnd(getCountSolution($cross), array('аз','аза','аз')); ?></td>
                                    <td><span class="icon-enlarge" style="font-size: 13px;"></span>Размеры:</td>
                                    <td><?=$crossData['cross_w']?>x<?=$crossData['cross_h']?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="seting_but">
                            <ul>
                                <li><a href="" id="bigger" onclick="biger(); return false;"> + Увеличить ячейки +</a></li>
                                <li><a href="" id="smally" onclick="smally(); return false;">- Уменьшить ячейки -</a></li>
                                <li><a href="" onclick="clearCross(); return false;">Очистить</a></li>
                                <!--<li><a href="">Мобильная версия</a></li>-->
                            </ul>    
                        </div>
                        <div class="seting_but2">
                            <ul>
                                <li><a href="" onclick="rewerse(); return false;">Отменить<span id="rew"></span></a></li>
                                <li><a href="" onclick="answer(); return false;">Ответ</a></li>
                                <li><a href="" onclick="save(); return false;">Сохранить</a></li>
                                <li><a href="" onclick="solution(); return false;">Проверить решение</a></li>
                            </ul>    
                        </div>
                        <div id="message"></div>
                        <div id="frame">
                        <table class="<?=$sess_size?>" id="work_file" oncontextmenu="return false;">
                <tbody>
                    <tr>         
                        <td id="scroll_td">&nbsp;</td>
                        <td  id="scroll_tr">
                            <table>
                                <tbody>
                                <?php $count_tr_top = 0; $count_td_top = 0; foreach($arr_top as $item_top){
                                    echo "<tr>";
                                    foreach($item_top as $item_td_top){
                                        if(($count_td_top + 1)%5 == 0 && ($count_td_top + 1) != count($item_top)){$class_num_5 = ' td_str5';}else{$class_num_5 = '';}      
                                ?>
                                      <td <?php if($item_td_top[0] == 'n'){echo 'class="td_null'.$class_num_5.'"';}else{echo 'id="cnt'.$count_td_top.'_'.$count_tr_top.'" onmousedown="crossNumderTop(event, '.$count_td_top.', '.$count_tr_top.')" class="kletka'.$class_num_5.'"';} ?>>
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
                                        <td <?php if($item_td_left[0] == 'n'){echo 'class="td_null"';}else{echo 'id="cnl'.$count_tr_left.'_'.$count_td_left.'" onmousedown="crossNumderLeft(event, '.$count_tr_left.', '.$count_td_left.')" class="kletka"';} ?>>
                                            <div><?php if($item_td_left[0] == 'n'){echo '&nbsp;';}else{echo $item_td_left[0];} ?></div>
                                        </td>
                                        <?php $count_td_left++; } ?>
                                    </tr>
                                    <?php $count_td_left = 0; $count_tr_left++; } ?>
                                </tbody>
                            </table>
                        </td>
                        <td onmouseover="hoverFrame(event)">
                            <table>
                                <tbody>
                                    <?php $count_arr_history = 0;
                                        for($tr = 0; $tr < $crossData['cross_h']; $tr++){
                                            if(($tr + 1)%5 == 0 && ($tr + 1) != $crossData['cross_h']){$class_num_5 = ' class="tr_str5"';}else{$class_num_5 = '';}
                                            if(($tr + 1) == $crossData['cross_h']){$scroll_ecv = ' id="scroll_ecv"';}
                                    ?>
                                    <tr<?php echo $class_num_5.$scroll_ecv; ?>>
                                        <?php 
                                            for($td = 0; $td < $crossData['cross_w']; $td++){ 
                                                if(($td + 1)%5 == 0 && ($td + 1) != $crossData['cross_w']){$class_num_5 = ' td_str5';}else{$class_num_5 = '';}    
                                        ?>
                                        <td class="cma<?=$class_num_5?>" id="cma<?=$tr?>_<?=$td?>" onmousedown="crossPic(event, <?=$tr?>, <?=$td?>)" onmouseover="hoverCrossPic(event, <?=$tr?>, <?=$td?>)"<?php if($sess_showxy){echo ' title="('.$tr.' - '.$td.')"';}if($arr_history[$count_arr_history] == 1){echo ' style="background-color: black;"';}elseif($arr_history[$count_arr_history] == 2){echo ' style="background-image: url(\'images/'.IMG_CROSS.'\');"';}?>>
                                            <div>&nbsp;</div>
                                        </td>
                                        <?php $count_arr_history++;} ?>
                                    </tr>
                                    <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    
                </tbody>
            </table>
                        <div class="seting">
                            <h3>Настройки для удобного решения.</h3>
                            <form>
                                <label><input type="checkbox" <?=$sess_numligth?> name="num_light" id="num_ligth" onchange="numLight();"/> Подсветка цифр</label><br>
                                <label><input type="checkbox" <?=$sess_frame?> name="show_frame" id="show_frame" onchange="showFrame();"/> Подсвечивать клетку под курсором</label><br>
                                <label><input type="checkbox" <?=$sess_lastnum?> name="last_num" id="last_num" onchange="lastNum();"/> Последняя зачеркнутая цифра заполняет строку/столбец крестиками</label><br>
                                <label><input type="checkbox" <?=$sess_showxy?> name="show_xy" id="show_xy" onchange="showXY();"/> Отображать координаты клетки под курсором</label><br>
                                <label><input type="checkbox" <?=$sess_scrolltop?> name="scroll_top" id="scroll_top" onchange="scrollTopPanell();"/> Перемещать верхнюю панель</label><br>
                                <label><input type="checkbox" <?=$sess_show_number?> name="scroll_show_number" id="scroll_show_number" onchange="showNumber();"/> Подсказка с количеством закращеных клеток</label><br>
                                <label><input type="checkbox" name="show_timer" id="show_timer" onchange="showTimer();"/> Скрыть/показать таймер</label><br>
                            </form>
                        </div>
                        <!-- START COMMENTS -->
<?php include("comments.view.php"); ?>
                        <!-- END COMMENTS -->
                        <div id="array_history"><?=$history?></div>

                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>