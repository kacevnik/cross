                    <div class="content">
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']); 
?>
                    <table class="lk">
                        <tr>
                            <td>Логин:</td>
                            <td><?=$login?></td>
                        </tr>
                        <?php if($_SESSION['admin'] == $proverka){ ?>
                        <tr>
                            <td>E-mail:</td>
                            <td><?=$email?> (Не виден другим пользователям)</td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>Дата регистрации</td>
                            <td><?=$time_add?></td>
                        </tr>
                        <tr>
                            <td>Решено кроссвордов</td>
                            <td><?php echo $solution; if($countSecSol > 0){echo ' (на решение ушло: '.getCountSec($countSecSol).')';} ?></td>
                        </tr>
                        <tr>
                            <td>Рейтинг</td>
                            <td>#<?php echo $mesto; if($reting > 0){echo " (".round($reting, 4).")" ;}?></td>
                        </tr>
                        <tr>
                            <td>Добавлено кроссвордов</td>
                            <td><?=$add_user?></td>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>