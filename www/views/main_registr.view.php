                    <div class="content">
                        <h1>Регистрация</h1>
                        <table class="registr">
                            <form method="post" action="">
                            <tr>
                                <td>Логин *</td>
                                <td><input class="registr_in_text" name="login" type="text" /></td>
                            </tr>
                            <tr>
                                <td>E-mail адрес *</td>
                                <td><input class="registr_in_text" name="email" type="text" /></td>
                            </tr>
                            <tr>
                                <td>Пароль *</td>
                                <td><input class="registr_in_text" name="pass" type="text" /></td>
                            </tr>
                            <tr>
                                <td>Ещё раз пароль *</td>
                                <td><input class="registr_in_text" name="pass2" type="text" /></td>
                            </tr>
                            <tr class="r_capcha">
                                <td><span>Введите символы<br> с картинки *</span><img id="capcha" src="capcha.php" onclick="reload_capcha()" title="Обновить"></td>
                                <td><input class="registr_in_text" name="capcha" type="text" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="registr_in_sub" value="Регистрация" type="submit" /></td>
                            </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>