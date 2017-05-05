                    <div class="content">
                        <h1>Восстановление пароля</h1>
<?php
    echo $_SESSION['error'];
    unset($_SESSION['error']); 
    if(!$np){
?>
                        <table class="registr">
                            <form method="post">
                            <tr>
                                <td>Введите E-mail или Логин: *</td>
                                <td><input class="registr_in_text" name="email" type="text"/></td>
                            </tr>
                            <tr class="r_capcha">
                                <td><span>Введите символы<br> с картинки *</span><img id="capcha" src="capcha.php" onclick="reload_capcha()" title="Обновить"></td>
                                <td><input id="form_capcha" class="registr_in_text" name="capcha" type="text" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="registr_in_sub" name="submit_new_pass" value="Отправить" type="submit"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" id="reg_error" class="reg_error"></td>
                                <td></td>
                            </tr>
                            </form>
<?php }else{?>
                        <table class="registr">
                            <form method="post">
                            <tr>
                                <td>Придумайте новый пароль: *</td>
                                <td><input class="registr_in_text" name="pass" type="password"/></td>
                            </tr>
                            <tr>
                                <td>Повтарите новый пароль: *</td>
                                <td><input class="registr_in_text" name="pass2" type="password"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="registr_in_sub" name="submit" value="Сменить пароль" type="submit"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" id="reg_error" class="reg_error"></td>
                                <td></td>
                            </tr>
                            </form>
<?php } ?>
                            <tr>
                                <td>
                                    <ul>
                                        <li><a href="login.php">Вход в Личный кабинет</a></li>
                                    </ul>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>