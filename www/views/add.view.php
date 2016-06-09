                    <div class="content">
                        <h1>Добавить новый кроссворд</h1>
                        <div id="frame">
                <table class="add_size">
                <tbody>
                <tr>
                    <td>Название:</td>
                    <td><input id="add_name" class="add_name" name="name" autocomplete="off"/></td>
                </tr>               
                    <tr>
                        <td>Высота:</td>
                        <td><span onclick="clickBut(1)" onselectstart="return false" onmousedown="return false">-</span><input name="height" id="height_cross" value="10" type="text" autocomplete="off" onfocus="showLink()"/><span onclick="clickBut(2)" onselectstart="return false" onmousedown="return false">+</span></td>
                    </tr> 
                    <tr>
                        <td>Ширина:</td>
                        <td><span onclick="clickBut(3)" onselectstart="return false" onmousedown="return false">-</span><input name="width" id="width_cross" value="10" autocomplete="off" type="text" onfocus="showLink()"/><span onclick="clickBut(4)" onselectstart="return false" onmousedown="return false">+</span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><a onclick="reSize()" id="show_link" style="display: none;">Приминить размеры</a></td>
                        <td></td>
                    </tr> 
                </tbody>
            </table>
            <div class="seting_but">
                <ul>
                    <li><a href="" id="postSolution" onclick="postSolution(); return false;">Отправить на проверку</a></li>
                </ul>    
            </div>
            <div id="message"></div>
            <table class="cross_main_22" id="work_file" oncontextmenu="return false;">
                <tbody>
                    <tr>         
                        <td style="cursor: default; background: rgb(241, 241, 241); display: table-cell;" id="scroll_td1">&nbsp;</td>
                        <td id="scroll_td">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="td_null"></td>
                                        <td class="td_null"></td>
                                        <td class="td_null"></td>
                                        <td class="td_null"></td>
                                        <td class="td_null td_str5"></td>
                                        <td class="td_null"></td>
                                        <td class="td_null"></td>
                                        <td class="td_null"></td>
                                        <td class="td_null"></td>
                                        <td class="td_null"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tbody>
                                    <tr><td class="td_null"></td></tr>                                   
                                    <tr><td class="td_null"></td></tr>                                   
                                    <tr><td class="td_null"></td></tr>                                   
                                    <tr><td class="td_null"></td></tr>                                   
                                    <tr class="tr_str5"><td class="td_null"></td></tr>                                   
                                    <tr><td class="td_null"></td></tr>                                   
                                    <tr><td class="td_null"></td></tr>                                   
                                    <tr><td class="td_null"></td></tr>                                   
                                    <tr><td class="td_null"></td></tr>                                   
                                    <tr><td class="td_null"></td></tr>                                   
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tbody>
                                    <?php 
                                        for($tr = 0; $tr < 10; $tr++){
                                            if(($tr + 1)%5 == 0 && ($tr + 1) != 10){$class_num_5 = ' class="tr_str5"';}else{$class_num_5 = '';}
                                    ?>
                                    <tr<?php echo $class_num_5; ?>>
                                        <?php 
                                            for($td = 0; $td < 10; $td++){ 
                                                if(($td + 1)%5 == 0 && ($td + 1) != 10){$class_num_5 = ' td_str5';}else{$class_num_5 = '';}    
                                        ?>
                                        <td class="cma<?=$class_num_5?>" id="cma<?=$tr?>_<?=$td?>" onmousedown="crossPic(event, <?=$tr?>, <?=$td?>)" onmouseover="hoverCrossPic(event, <?=$tr?>, <?=$td?>)">
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
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>