                    <div class="content">
                        <h1>Японский кроссворд № <?=$crossData['id'].$showType?></h1>
                        <div class="cross_info">
                            <ul>
                                <li title="Этот японский кроссворд добавил <?=getLoginName($crossData['user_add_id'])?>"><span class="icon-user"></span>Добавил: <a href="user.php?id=<?=$crossData['user_add_id']?>"><?=getLoginName($crossData['user_add_id'])?></a></li>
                                <li><span class="icon-calendar"></span>Добавлен: <span class="cross_info_bold"><?=getShotDate($crossData['time_add'])?></span></li>
                                <li><span class="icon-target"></span>Решили: <span class="cross_info_bold"><?=getCountSolution($cross)?></span> р<?php echo numberEnd(getCountSolution($cross), array('аз','аза','аз')); ?></li>
                            </ul>
                            <ul>
                                <li><span class="icon-star-full"></span>Рейтинг: <?=showStars($crossData['count_star'])?></li>                                            
                                <li><span class="icon-trophy"></span>Сложность: <?=showStars($crossData['power'])?></li>
                            </ul>
                            <ul>
                                <li><span class="icon-hour-glass"></span>Ср. скорость: <span class="cross_info_bold"><?=getCountSec($crossData['s_time']);?></span></li>
                                <li><?php if(bestTime($cross)){$bestTime = bestTime($cross); ?><span class="icon-power" title="<?=getCountSec($bestTime[1])?>"></span>Рекорд: <a href="user.php?id=<?=$bestTime[0]?>"><?=getLoginName($bestTime[0])?></a> <?=getCountSec($bestTime[1])?><?php } ?></li>
                            </ul>
                            <ul>
                                <li><span id="timer">00:00:00</span></li>
                            </ul>
                        </div>
                        <div class="seting_but">
                            <ul>
                                <li><a href="" id="bigger" onclick="biger(); return false;">Увеличить ячейки</a></li>
                                <li><a href="" id="smally" onclick="smally(); return false;">Уменьшить ячейки</a></li>
                                <!--<li><a href="">Мобильная версия</a></li>-->
                            </ul>    
                        </div>
                        <div class="seting_but">
                            <ul>
                                <li><a href="" onclick="rewerse(); return false;">Отменить<span id="rew"></span></a></li>
                                <!--<li><a href="">Сохранить</a></li>-->
                                <li><a href="" onclick="solution(); return false;">Проверить решение</a></li>
                            </ul>    
                        </div>
                        <div id="message"></div>
                        <div id="frame">
                        <table class="<?=$sess_size?>" id="work_file" oncontextmenu="return false;">
                <tbody>
                    <tr id="scroll_tr">         
                        <td style="cursor: default; background: rgb(241, 241, 241); display: table-cell;" id="scroll_td1">&nbsp;</td>
                        <td id="scroll_td">
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
                                        <td <?php if($item_td_left[0] == 'n'){echo 'class="td_null"';}else{echo 'id="cnl'.$count_tr_left.'_'.$count_td_left.'" onmousedown="crossNumderLeft(event, '.$count_tr_left.', '.$count_td_left.')" class="kletka"';} ?>>
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
                                                if(($td + 1)%5 == 0 && ($td + 1) != $crossData['cross_w']){$class_num_5 = ' td_str5';}else{$class_num_5 = '';}    
                                        ?>
                                        <td class="cma<?=$class_num_5?>" id="cma<?=$tr?>_<?=$td?>" onmousedown="crossPic(event, <?=$tr?>, <?=$td?>)" onmouseover="hoverCrossPic(event, <?=$tr?>, <?=$td?>)"<?php if($sess_showxy){echo ' title="('.$tr.' - '.$td.')"';}?>>
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
                        <div class="seting">
                            <h3>Настройки для удобного решения.</h3>
                            <form>
                                <label><input type="checkbox" <?=$sess_numligth?> name="num_light" id="num_ligth" onchange="numLight();"/> Подсветка цифр</label><br>
                                <label><input type="checkbox" <?=$sess_frame?> name="show_frame" id="show_frame" onchange="showFrame();"/> Подсвечивать клетку под курсором</label><br>
                                <label><input type="checkbox" <?=$sess_lastnum?> name="last_num" id="last_num" onchange="lastNum();"/> Последняя зачеркнутая цифра заполняет строку/столбец крестиками</label><br>
                                <label><input type="checkbox" <?=$sess_showxy?> name="show_xy" id="show_xy" onchange="showXY();"/> Отображать координаты клетки под курсором</label><br>
                                <label><input type="checkbox" <?=$sess_scrolltop?> name="scroll_top" id="scroll_top" onchange="scrollTopPanell();"/> Перемещать верхнюю панель</label><br>
                                <label><input type="checkbox" name="show_timer" id="show_timer" onchange="showTimer();"/> Скрыть/показать таймер</label><br>
                            </form>
                        </div>
                        <!-- c -->
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>