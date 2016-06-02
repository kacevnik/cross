                    <div class="content">
                        <h1>Регистрация</h1>
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']); 
?>
                        <table class="registr">
                            <form method="post" action="" onsubmit="return sub()">
                            <tr>
                                <td>Логин *</td>
                                <td><input id="form_login" class="registr_in_text" name="login" type="text" onfocus="clear_in(this)"/></td>
                            </tr>
                            <tr>
                                <td>E-mail адрес *</td>
                                <td><input id="form_email" class="registr_in_text" name="email" type="text" onfocus="clear_in(this)"/></td>
                            </tr>
                            <tr>
                                <td>Пароль *</td>
                                <td><input id="form_pass" class="registr_in_text" name="pass" type="password" onfocus="clear_in(this)"/></td>
                            </tr>
                            <tr>
                                <td>Ещё раз пароль *</td>
                                <td><input id="form_pass2" class="registr_in_text" name="pass2" type="password" onfocus="clear_in(this)"/></td>
                            </tr>
                            <tr class="r_capcha">
                                <td><span>Введите символы<br> с картинки *</span><img id="capcha" src="capcha.php" onclick="reload_capcha()" title="Обновить"></td>
                                <td><input id="form_capcha" class="registr_in_text" name="capcha" type="text" onfocus="clear_in(this)"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="registr_in_sub" name="submit" value="Регистрация" type="submit" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" id="reg_error" class="reg_error"></td>
                                <td></td>
                            </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>