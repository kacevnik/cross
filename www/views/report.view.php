                    <div class="content">
                        <h1>Японский кроссворд № <?=$crossData['id'].$showType.$public_date?></h1>
                            <table class="add_size">
                                <tbody>
                                <tr>
                                    <td>Код:</td>
                                    <td><input id="report_pass" class="add_name" name="pass" autocomplete="off"/></td>
                                </tr>
                                <tr>
                                    <td>Название:</td>
                                    <td><input id="add_name" class="add_name" name="name" value="<?=$crossData['name']?>" autocomplete="off"/></td>
                                </tr>
                                <tr>
                                    <td>Дата публикации:</td>
                                    <td>
                                        <label id="label_show_date"><input type="checkbox" name="show_date" id="show_date" onchange="show_date();"/> Устанвить дату и время?</label>
                                        <div id="show_set_date">
                                            <select id="select_h" name="select_h">
                                                <option value="0">00</option>
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>
                                                <option value="6">06</option>
                                                <option value="7">07</option>
                                                <option value="8">08</option>
                                                <option value="9">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                            </select>
                                            <strong> :</strong>
                                            <select id="select_m" name="select_m">
                                                <option value="0">00</option>
                                                <option value="1">05</option>
                                                <option value="2">10</option>
                                                <option value="3">15</option>
                                                <option value="4">20</option>
                                                <option value="5">25</option>
                                                <option value="6">30</option>
                                                <option value="7">35</option>
                                                <option value="8">40</option>
                                                <option value="9">45</option>
                                                <option value="10">50</option>
                                                <option value="11">55</option>
                                            </select>
                                            <strong> -</strong>
                                            <input id="cal_date" name="cal_date" value="<?php echo date("Y-m-d"); ?>" autocomplete="off"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Высота:</td>
                                    <td><span onclick="clickBut(1)" onselectstart="return false" onmousedown="return false">-</span><input name="height" id="height_cross" value="<?=$crossData['cross_h']?>"" type="text" autocomplete="off" onfocus="showLink()"/><span onclick="clickBut(2)" onselectstart="return false" onmousedown="return false">+</span></td>
                                </tr> 
                                <tr>
                                    <td>Ширина:</td>
                                    <td><span onclick="clickBut(3)" onselectstart="return false" onmousedown="return false">-</span><input name="width" id="width_cross" value="<?=$crossData['cross_w']?>"" autocomplete="off" type="text" onfocus="showLink()"/><span onclick="clickBut(4)" onselectstart="return false" onmousedown="return false">+</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><a onclick="reSize()" id="show_link" style="display: none;">Приминить размеры</a></td>
                                    <td></td>
                                </tr> 
                                </tbody>
                            </table>
                        <div class="seting_but">
                            <ul>
                                <li><a href="" id="bigger" onclick="biger(); return false;">Увеличить ячейки</a></li>
                                <li><a href="" id="smally" onclick="smally(); return false;">Уменьшить ячейки</a></li>
                                <li><a href="" id="postSolution" onclick="postSolution(<?=$crossData['id']?>); return false;">Принять</a></li>
                                <li><a href="" onclick="delCross(<?=$crossData['id']?>); return false;">Удалить</a></li>
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
                        <td>
                            <table>
                                <tbody>
                                    <?php 
                                        $countSolution = 0;
                                        for($tr = 0; $tr < $crossData['cross_h']; $tr++){
                                            if(($tr + 1)%5 == 0 && ($tr + 1) != $crossData['cross_h']){$class_num_5 = ' class="tr_str5"';}else{$class_num_5 = '';}
                                    ?>
                                    <tr<?php echo $class_num_5; ?>>
                                        <?php 
                                            for($td = 0; $td < $crossData['cross_w']; $td++){ 
                                                if(($td + 1)%5 == 0 && ($td + 1) != $crossData['cross_w']){$class_num_5 = ' td_str5';}else{$class_num_5 = '';}
                                                if($solution[$countSolution] == 1){$black = ' style="background-color: black;"';}else{$black = '';}    
                                        ?>
                                        <td class="cma<?=$class_num_5?>" id="cma<?=$tr?>_<?=$td?>" onmousedown="crossPic(event, <?=$tr?>, <?=$td?>)" onmouseover="hoverCrossPic(event, <?=$tr?>, <?=$td?>)"<?php if($sess_showxy){echo ' title="('.$tr.' - '.$td.')"';} echo $black;?>>
                                            <div>&nbsp;</div>
                                        </td>
                                        <?php $countSolution++;} ?>
                                    </tr>
                                    <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                </tbody>
            </table>
            <img  src="img.php?id=<?=$crossData['id']?>" style="margin-top: 20px;"/>
            <img  src="img2.php?id=<?=$crossData['id']?>" style="margin-top: 20px;"/>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>