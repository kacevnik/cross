<?php
    include("inc/core.php");
    
    $res = getArrayTop(1);
    $arr_top = strToArr($res[arr_top]);
    print_arr($arr_top);
?>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="kacevnik" />
        <link rel="stylesheet" href="http://www.nonograms.ru/css/style.033.static.css" type="text/css">
    	<title>Японик</title>
        <style>
            td{background-position: 50%, 50%;}
        </style>
    </head>
    <body>
    <table class="nonogram_table" id="nonogram_table" oncontextmenu="return false;">
        <tbody>
            <tr>         
                <td style="background:#f0f0f0;cursor:default;" id="nmti">&nbsp;</td>
                <td class="nmtt">
                    <table>
                        <tbody>
                        <?php $count_tr_top = 0; $count_td_top = 0; foreach($arr_top as $item_top){
                            echo "<tr>";
                            foreach($item_top as $item_td_top){
                                if(($count_td_top + 1)%5 == 0 && ($count_td_top + 1) != count($item_top)){$class_num_5 = ' nmt_td5';}else{$class_num_5 = '';}      
                        ?>
                              <td <?php if($item_td_top[0] == 'n'){echo 'class="num_empty"';}else{echo 'id="cnt'.$count_td_top.'_'.$count_tr_top.'" onmousedown="crossNumderTop(event, '.$count_td_top.', '.$count_tr_top.')" class="num'.$class_num_5.'"';} ?>>
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
                            <tr>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td><td id="cnt1_1" onmousedown="crossNumderTop(event,1,1)" class="num">
                                    <div>3</div>
                                </td><td id="cnt2_1" onmousedown="crossNumderTop(event,2,1)" class="num">
                                    <div>2</div>
                                </td>
                                <td id="cnt3_1" onmousedown="crossNumderTop(event,3,1)" class="num">
                                    <div>1</div>
                                </td>
                                <td id="cnt4_1" onmousedown="crossNumderTop(event,4,1)" class="num nmt_td5">
                                    <div>1</div>
                                </td>
                                <td id="cnt5_1" onmousedown="crossNumderTop(event,5,1)" class="num">
                                    <div>2</div>
                                </td>
                                <td id="cnt6_1" onmousedown="crossNumderTop(event,6,1)" class="num">
                                    <div>1</div>
                                </td>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            <tr>
                                <td id="cnt0_2" onmousedown="crossNumderTop(event,0,2)" class="num">
                                    <div>10</div>
                                </td>
                                <td id="cnt1_2" onmousedown="crossNumderTop(event,1,2)" class="num">
                                    <div>2</div>
                                </td>
                                <td id="cnt2_2" onmousedown="crossNumderTop(event,2,2)" class="num">
                                    <div>1</div>
                                </td>
                                <td id="cnt3_2" onmousedown="crossNumderTop(event,3,2)" class="num">
                                    <div>4</div>
                                </td>
                                <td id="cnt4_2" onmousedown="crossNumderTop(event,4,2)" class="num nmt_td5">
                                    <div>5</div>
                                </td>
                                <td id="cnt5_2" onmousedown="crossNumderTop(event,5,2)" class="num">
                                    <div>2</div>
                                </td>
                                <td id="cnt6_2" onmousedown="crossNumderTop(event,6,2)" class="num">
                                    <div>6</div>
                                </td>
                                <td id="cnt7_2" onmousedown="crossNumderTop(event,7,2)" class="num">
                                    <div>8</div>
                                </td>
                                <td id="cnt8_2" onmousedown="crossNumderTop(event,8,2)" class="num">
                                    <div>6</div>
                                </td>
                                <td id="cnt9_2" onmousedown="crossNumderTop(event,9,2)" class="num">
                                    <div>4</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="nmtl">
                    <table>
                        <tbody>
                            <tr>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cnl0_2" onmousedown="crossNumderRight(event,0,2)" class="num">
                                    <div>7</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cnl1_1" onmousedown="crossNumderRight(event,1,1)" class="num">
                                    <div>3</div>
                                </td>
                                <td id="cnl1_2" onmousedown="crossNumderRight(event,1,2)" class="num">
                                    <div>1</div>
                                </td>
                            </tr>
                            <tr>
                                <td id="cnl2_0" onmousedown="crossNumderRight(event,2,0)" class="num">
                                    <div>2</div>
                                </td>
                                <td id="cnl2_1" onmousedown="crossNumderRight(event,2,1)" class="num">
                                    <div>1</div>
                                </td>
                                <td id="cnl2_2" onmousedown="crossNumderRight(event,2,2)" class="num">
                                    <div>2</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cnl3_1" onmousedown="crossNumderRight(event,3,1)" class="num">
                                    <div>1</div>
                                </td>
                                <td id="cnl3_2" onmousedown="crossNumderRight(event,3,2)" class="num">
                                    <div>3</div>
                                </td>
                            </tr>
                            <tr class="nmt_tr5">
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cnl4_1" onmousedown="crossNumderRight(event,4,1)" class="num">
                                    <div>1</div>
                                </td>
                                <td id="cnl4_2" onmousedown="crossNumderRight(event,4,2)" class="num">
                                    <div>4</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cnl5_1" onmousedown="crossNumderRight(event,5,1)" class="num">
                                    <div>1</div>
                                </td>
                                <td id="cnl5_2" onmousedown="crossNumderRight(event,5,2)" class="num">
                                    <div>6</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cnl6_1" onmousedown="crossNumderRight(event,6,1)" class="num">
                                    <div>1</div>
                                </td>
                                <td id="cnl6_2" onmousedown="crossNumderRight(event,6,2)" class="num">
                                    <div>7</div>
                                </td>
                            </tr>
                            <tr>
                                <td id="cnl7_0" onmousedown="crossNumderRight(event,7,0)" class="num">
                                    <div>1</div>
                                </td>
                                <td id="cnl7_1" onmousedown="crossNumderRight(event,7,1)" class="num">
                                    <div>2</div>
                                </td>
                                <td id="cnl7_2" onmousedown="crossNumderRight(event,7,2)" class="num">
                                    <div>3</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cnl8_1" onmousedown="crossNumderRight(event,8,1)" class="num">
                                    <div>2</div>
                                </td>
                                <td id="cnl8_2" onmousedown="crossNumderRight(event,8,2)" class="num">
                                    <div>5</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td class="num_empty">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cnl9_2" onmousedown="crossNumderRight(event,9,2)" class="num">
                                    <div>7</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class="nmtc">
                    <table>
                        <tbody>
                            <tr id="l0">
                                <td id="cma0_0" onmousedown="crossPic(event, 0, 0)" onmouseover="hoverCrossPic(event, 0, 0)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma0_1" onmousedown="crossPic(event, 0, 1)" onmouseover="hoverCrossPic(event, 0, 1)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma0_2" onmousedown="crossPic(event, 0, 2)" onmouseover="hoverCrossPic(event, 0, 2)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma0_3" onmousedown="crossPic(event, 0, 3)" onmouseover="hoverCrossPic(event, 0, 3)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma0_4" onmousedown="crossPic(event, 0, 4)" onmouseover="hoverCrossPic(event, 0, 4)" class="nmt_td5">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma0_5" onmousedown="crossPic(event, 0, 5)" onmouseover="hoverCrossPic(event, 0, 5)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma0_6" onmousedown="crossPic(event, 0, 6)" onmouseover="hoverCrossPic(event, 0, 6)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma0_7" onmousedown="crossPic(event, 0, 7)" onmouseover="hoverCrossPic(event, 0, 7)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma0_8" onmousedown="crossPic(event, 0, 8)" onmouseover="hoverCrossPic(event, 0, 8)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma0_9" onmousedown="crossPic(event, 0, 9)" onmouseover="hoverCrossPic(event, 0, 9)">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            <tr id="l1">
                                <td id="cma1_0" onmousedown="crossPic(event, 1, 0)" onmouseover="hoverCrossPic(event, 1, 0)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma1_1" onmousedown="crossPic(event, 1, 1)" onmouseover="hoverCrossPic(event, 1, 1)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma1_2" onmousedown="crossPic(event, 1, 2)" onmouseover="hoverCrossPic(event, 1, 2)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma1_3" onmousedown="crossPic(event, 1, 3)" onmouseover="hoverCrossPic(event, 1, 3)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma1_4" onmousedown="crossPic(event, 1, 4)" onmouseover="hoverCrossPic(event, 1, 4)" class="nmt_td5">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma1_5" onmousedown="crossPic(event, 1, 5)" onmouseover="hoverCrossPic(event, 1, 5)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma1_6" onmousedown="crossPic(event, 1, 6)" onmouseover="hoverCrossPic(event, 1, 6)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma1_7" onmousedown="crossPic(event, 1, 7)" onmouseover="hoverCrossPic(event, 1, 7)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma1_8" onmousedown="crossPic(event, 1, 8)" onmouseover="hoverCrossPic(event, 1, 8)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma1_9" onmousedown="crossPic(event, 1, 9)" onmouseover="hoverCrossPic(event, 1, 9)">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            <tr id="l2">
                                <td id="cma2_0" onmousedown="crossPic(event, 2, 0)" onmouseover="hoverCrossPic(event, 2, 0)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma2_1" onmousedown="crossPic(event, 2, 1)" onmouseover="hoverCrossPic(event, 2, 1)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma2_2" onmousedown="crossPic(event, 2, 2)" onmouseover="hoverCrossPic(event, 2, 2)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma2_3" onmousedown="crossPic(event, 2, 3)" onmouseover="hoverCrossPic(event, 2, 3)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma2_4" onmousedown="crossPic(event, 2, 4)" onmouseover="hoverCrossPic(event, 2, 4)" class="nmt_td5">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma2_5" onmousedown="crossPic(event, 2, 5)" onmouseover="hoverCrossPic(event, 2, 5)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma2_6" onmousedown="crossPic(event, 2, 6)" onmouseover="hoverCrossPic(event, 2, 6)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma2_7" onmousedown="crossPic(event, 2, 7)" onmouseover="hoverCrossPic(event, 2, 7)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma2_8" onmousedown="crossPic(event, 2, 8)" onmouseover="hoverCrossPic(event, 2, 8)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma2_9" onmousedown="crossPic(event, 2, 9)" onmouseover="hoverCrossPic(event, 2, 9)">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            <tr id="l3">
                                <td id="cma3_0" onmousedown="crossPic(event, 3, 0)" onmouseover="hoverCrossPic(event, 3, 0)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma3_1" onmousedown="crossPic(event, 3, 1)" onmouseover="hoverCrossPic(event, 3, 1)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma3_2" onmousedown="crossPic(event, 3, 2)" onmouseover="hoverCrossPic(event, 3, 2)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma3_3" onmousedown="crossPic(event, 3, 3)" onmouseover="hoverCrossPic(event, 3, 3)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma3_4" onmousedown="crossPic(event, 3, 4)" onmouseover="hoverCrossPic(event, 3, 4)" class="nmt_td5">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma3_5" onmousedown="crossPic(event, 3, 5)" onmouseover="hoverCrossPic(event, 3, 5)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma3_6" onmousedown="crossPic(event, 3, 6)" onmouseover="hoverCrossPic(event, 3, 6)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma3_7" onmousedown="crossPic(event, 3, 7)" onmouseover="hoverCrossPic(event, 3, 7)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma3_8" onmousedown="crossPic(event, 3, 8)" onmouseover="hoverCrossPic(event, 3, 8)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma3_9" onmousedown="crossPic(event, 3, 9)" onmouseover="hoverCrossPic(event, 3, 9)">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            <tr id="l4"  class="nmt_tr5">
                                <td id="cma4_0" onmousedown="crossPic(event, 4, 0)" onmouseover="hoverCrossPic(event, 4, 0)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma4_1" onmousedown="crossPic(event, 4, 1)" onmouseover="hoverCrossPic(event, 4, 1)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma4_2" onmousedown="crossPic(event, 4, 2)" onmouseover="hoverCrossPic(event, 4, 2)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma4_3" onmousedown="crossPic(event, 4, 3)" onmouseover="hoverCrossPic(event, 4, 3)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma4_4" onmousedown="crossPic(event, 4, 4)" onmouseover="hoverCrossPic(event, 4, 4)" class="nmt_td5">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma4_5" onmousedown="crossPic(event, 4, 5)" onmouseover="hoverCrossPic(event, 4, 5)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma4_6" onmousedown="crossPic(event, 4, 6)" onmouseover="hoverCrossPic(event, 4, 6)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma4_7" onmousedown="crossPic(event, 4, 7)" onmouseover="hoverCrossPic(event, 4, 7)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma4_8" onmousedown="crossPic(event, 4, 8)" onmouseover="hoverCrossPic(event, 4, 8)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma4_9" onmousedown="crossPic(event, 4, 9)" onmouseover="hoverCrossPic(event, 4, 9)">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            <tr id="l5">
                                <td id="cma5_0" onmousedown="crossPic(event, 5, 0)" onmouseover="hoverCrossPic(event, 5, 0)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma5_1" onmousedown="crossPic(event, 5, 1)" onmouseover="hoverCrossPic(event, 5, 1)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma5_2" onmousedown="crossPic(event, 5, 2)" onmouseover="hoverCrossPic(event, 5, 2)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma5_3" onmousedown="crossPic(event, 5, 3)" onmouseover="hoverCrossPic(event, 5, 3)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma5_4" onmousedown="crossPic(event, 5, 4)" onmouseover="hoverCrossPic(event, 5, 4)" class="nmt_td5">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma5_5" onmousedown="crossPic(event, 5, 5)" onmouseover="hoverCrossPic(event, 5, 5)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma5_6" onmousedown="crossPic(event, 5, 6)" onmouseover="hoverCrossPic(event, 5, 6)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma5_7" onmousedown="crossPic(event, 5, 7)" onmouseover="hoverCrossPic(event, 5, 7)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma5_8" onmousedown="crossPic(event, 5, 8)" onmouseover="hoverCrossPic(event, 5, 8)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma5_9" onmousedown="crossPic(event, 5, 9)" onmouseover="hoverCrossPic(event, 5, 9)">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            <tr id="l6">
                                <td id="cma6_0" onmousedown="crossPic(event, 6, 0)" onmouseover="hoverCrossPic(event, 6, 0)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma6_1" onmousedown="crossPic(event, 6, 1)" onmouseover="hoverCrossPic(event, 6, 1)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma6_2" onmousedown="crossPic(event, 6, 2)" onmouseover="hoverCrossPic(event, 6, 2)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma6_3" onmousedown="crossPic(event, 6, 3)" onmouseover="hoverCrossPic(event, 6, 3)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma6_4" onmousedown="crossPic(event, 6, 4)" onmouseover="hoverCrossPic(event, 6, 4)" class="nmt_td5">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma6_5" onmousedown="crossPic(event, 6, 5)" onmouseover="hoverCrossPic(event, 6, 5)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma6_6" onmousedown="crossPic(event, 6, 6)" onmouseover="hoverCrossPic(event, 6, 6)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma6_7" onmousedown="crossPic(event, 6, 7)" onmouseover="hoverCrossPic(event, 6, 7)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma6_8" onmousedown="crossPic(event, 6, 8)" onmouseover="hoverCrossPic(event, 6, 8)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma6_9" onmousedown="crossPic(event, 6, 9)" onmouseover="hoverCrossPic(event, 6, 9)">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            <tr id="l7">
                                <td id="cma7_0" onmousedown="crossPic(event, 7, 0)" onmouseover="hoverCrossPic(event, 7, 0)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma7_1" onmousedown="crossPic(event, 7, 1)" onmouseover="hoverCrossPic(event, 7, 1)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma7_2" onmousedown="crossPic(event, 7, 2)" onmouseover="hoverCrossPic(event, 7, 2)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma7_3" onmousedown="crossPic(event, 7, 3)" onmouseover="hoverCrossPic(event, 7, 3)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma7_4" onmousedown="crossPic(event, 7, 4)" onmouseover="hoverCrossPic(event, 7, 4)" class="nmt_td5">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma7_5" onmousedown="crossPic(event, 7, 5)" onmouseover="hoverCrossPic(event, 7, 5)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma7_6" onmousedown="crossPic(event, 7, 6)" onmouseover="hoverCrossPic(event, 7, 6)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma7_7" onmousedown="crossPic(event, 7, 7)" onmouseover="hoverCrossPic(event, 7, 7)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma7_8" onmousedown="crossPic(event, 7, 8)" onmouseover="hoverCrossPic(event, 7, 8)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma7_9" onmousedown="crossPic(event, 7, 9)" onmouseover="hoverCrossPic(event, 7, 9)">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            <tr id="l8">
                                <td id="cma8_0" onmousedown="crossPic(event, 8, 0)" onmouseover="hoverCrossPic(event, 8, 0)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma8_1" onmousedown="crossPic(event, 8, 1)" onmouseover="hoverCrossPic(event, 8, 1)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma8_2" onmousedown="crossPic(event, 8, 2)" onmouseover="hoverCrossPic(event, 8, 2)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma8_3" onmousedown="crossPic(event, 8, 3)" onmouseover="hoverCrossPic(event, 8, 3)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma8_4" onmousedown="crossPic(event, 8, 4)" onmouseover="hoverCrossPic(event, 8, 4)" class="nmt_td5">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma8_5" onmousedown="crossPic(event, 8, 5)" onmouseover="hoverCrossPic(event, 8, 5)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma8_6" onmousedown="crossPic(event, 8, 6)" onmouseover="hoverCrossPic(event, 8, 6)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma8_7" onmousedown="crossPic(event, 8, 7)" onmouseover="hoverCrossPic(event, 8, 7)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma8_8" onmousedown="crossPic(event, 8, 8)" onmouseover="hoverCrossPic(event, 8, 8)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma8_9" onmousedown="crossPic(event, 8, 9)" onmouseover="hoverCrossPic(event, 8, 9)">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            <tr id="l9">
                                <td id="cma9_0" onmousedown="crossPic(event, 9, 0)" onmouseover="hoverCrossPic(event, 9, 0)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma9_1" onmousedown="crossPic(event, 9, 1)" onmouseover="hoverCrossPic(event, 9, 1)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma9_2" onmousedown="crossPic(event, 9, 2)" onmouseover="hoverCrossPic(event, 9, 2)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma9_3" onmousedown="crossPic(event, 9, 3)" onmouseover="hoverCrossPic(event, 9, 3)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma9_4" onmousedown="crossPic(event, 9, 4)" onmouseover="hoverCrossPic(event, 9, 4)" class="nmt_td5">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma9_5" onmousedown="crossPic(event, 9, 5)" onmouseover="hoverCrossPic(event, 9, 5)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma9_6" onmousedown="crossPic(event, 9, 6)" onmouseover="hoverCrossPic(event, 9, 6)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma9_7" onmousedown="crossPic(event, 9, 7)" onmouseover="hoverCrossPic(event, 9, 7)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma9_8" onmousedown="crossPic(event, 9, 8)" onmouseover="hoverCrossPic(event, 9, 8)">
                                    <div>&nbsp;</div>
                                </td>
                                <td id="cma9_9" onmousedown="crossPic(event, 9, 9)" onmouseover="hoverCrossPic(event, 9, 9)">
                                    <div>&nbsp;</div>
                                </td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </td>
            
        </tbody>
    </table>
    <script src="js/script.js"></script>    
    </body>
</html>