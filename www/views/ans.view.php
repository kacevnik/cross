<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
?>
                    <div class="content">
                        <h1>Обратная связь.</h1>
<?php
    echo $_SESSION['error'];
    unset($_SESSION['error']); 
?>
                        <table class="registr">
                            <form method="post" action="" onsubmit="return sub_ans()">
                            <tr>
                                <td>Ваше имя *</td>
                                <td><input id="form_name_ans" class="registr_in_text" name="name" type="text" onfocus="clear_in(this)"/></td>
                            </tr>
                            <tr>
                                <td>E-mail адрес *</td>
                                <td><input id="form_email_ans" class="registr_in_text" name="email" type="text" onfocus="clear_in(this)"/></td>
                            </tr>
                            <tr>
                                <td>Текст сообщения *</td>
                                <td><textarea class="registr_in_text" id="form_text_ans" name="text" style="width: 400px; height: 90px; resize: vertical; margin-top: 0px; margin-bottom: 15px;"></textarea></td>
                            </tr>
                            <tr class="r_capcha">
                                <td><span>Введите символы<br> с картинки *</span><img id="capcha" src="capcha.php" onclick="reload_capcha()" title="Обновить"></td>
                                <td><input id="form_capcha_ans" class="registr_in_text" name="capcha" type="text" onfocus="clear_in(this)" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="registr_in_sub" name="submit" value="Отправить" type="submit" /></td>
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