<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
?>                    
                    <div class="content best_list_style">
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']);
 if($show_reiting == 1){
    $i = 1;
?>
                        <h1>Рейтинг Лучших игроков</h1>
                        <div class="best_list">
                            <table>
                                <tr class="tr_header">
                                    <td>Место</td>
                                    <td>Имя</td>
                                    <td>Очки</td>
                                </tr>
<?php
    do{
        if($i%2==0){$od_style = ' class="odd_best_list_item"';}else{$od_style = ''; }
        foreach ($option_list as $key => $value) {
            if($value == $myr['id']){
                if($i == $key+1){
                    $move_list = '';
                    $green_red = '';
                    break;
                }else{
                    if(($key+1)-$i > 0){$green_red =' move_to_best_list_green'; }else{$green_red =' move_to_best_list_red';}
                    if(($key+1)-$i > 0){$move_list_plus = '+';}else{$move_list_plus = '';}
                    $move_list.=($key+1)-$i;
                    if(($key+1)-$i > 0){$move_list_i.=' <i class="fa fa-caret-up"></i>'; }else{$move_list_i.=' <i class="fa fa-caret-down"></i>';}
                    break;
                }
            }else{
                $green_red = '';
                $move_list = '';
                $move_list_plus = '';
                $move_list_i = '';
            }
        }
?>
                                <tr<?php echo $od_style; ?>>
                                    <td>#<?php echo $i; ?><span class="move_to_best_list<?php echo $green_red; ?>"><?php echo $move_list_plus.$move_list.$move_list_i; ?></span></td>
                                    <td><a href="user.php?id=<?php echo $myr['id']; ?>"><?php echo $myr['login_view']; ?></a></td>
                                    <td><?php echo round($myr['reting'], 2); ?></td>
                                </tr> 
<?php
    $green_red = '';
    $move_list = '';
    $move_list_plus = '';
    $move_list_i = '';
    $i++;
    }while($myr = mysqli_fetch_assoc($res));
?>                              
                            </table>   
                        </div>
<?php 
    }
?>
                    </div>
                </div>
            </div>
        </div>
    </div>