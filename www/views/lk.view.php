                    <div class="content">
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']); 
?>
                        <table class="registr">
                            <form method="post" action="" onsubmit="return sub()">
                            <tr>
                                <td>Логин *</td>
                                <td><input id="form_login" class="registr_in_text" name="login" type="text"/></td>
                            </tr>
                            <tr>
                                <td>Пароль *</td>
                                <td><input id="form_pass" class="registr_in_text" name="pass" type="password"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="registr_in_sub" name="submit" value="Войти" type="submit" /></td>
                            </tr>
                            </form>
                            <tr>
                                <td>
                                    <ul>
                                        <li><a href="registr.php">Рнгистрация</a></li>
                                        <li><a href="new_pass.php">Забыли пароль?</a></li>
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