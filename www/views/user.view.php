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
                        <?php if($_SESSION['admin']){ ?>
                        <tr>
                            <td>E-mail:</td>
                            <td><?=$email?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>Дата регистрации</td>
                            <td><?=$time_add?></td>
                        </tr>
                        <tr>
                            <td>Решено кроссвордов</td>
                            <td><?=$solution?></td>
                        </tr>
                        <tr>
                            <td>Рейтинг</td>
                            <td>#<?php echo $mesto." (".round($reting, 4).")" ;?></td>
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