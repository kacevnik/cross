<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
?>                    
                    <div class="content">
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']);
 if($show_reiting == 1){
    $i = 1;
?>
                        <h1>Рейтинг Лучших игроков</h1>
                        <div class="best_list">
                            <table>
                                <tr>
                                    <td>Место</td>
                                    <td>Имя</td>
                                    <td>Очки</td>
                                </tr>
<?php
    do{
?>
                                <tr>
                                    <td>#<i class="fa fa-address-book"></i> <?php echo $i; ?></td>
                                    <td><a href="user.php?id=<?php echo $myr['id']; ?>"><?php echo $myr['login_view']; ?></a></td>
                                    <td><?php echo round($myr['reting'], 2); ?></td>
                                </tr> 
<?php
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