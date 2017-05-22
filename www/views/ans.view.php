<?php
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
?>
                    <div class="content">
                        <h1>Обратная связь.</h1>
<?php
    echo $_SESSION['error'];
    unset($_SESSION['error']); 
?>
                        <div class="ans_form">
                            <form method="post" action="" onsubmit="return sub_ans()">
                            <div class="ans_form_row">
                                <div class="ans_form_left_col">Ваше имя *</div>
                                <div class="ans_form_right_col"><input id="form_name_ans" class="registr_in_text" name="name" type="text" onfocus="clear_in(this)"/></div>
                            </div>
                            <div class="ans_form_row">
                                <div class="ans_form_left_col">E-mail адрес *</div>
                                <div class="ans_form_right_col"><input id="form_email_ans" class="registr_in_text" name="email" type="text" onfocus="clear_in(this)"/></div>
                            </div>
                            <div class="ans_form_row">
                                <div class="ans_form_left_col">Текст сообщения *</div>
                                <div class="ans_form_right_col"><textarea class="registr_in_text" id="form_text_ans" name="text" style="width: 400px; height: 90px; resize: vertical; margin-top: 0px; margin-bottom: 15px;"></textarea></div>
                            </div>
                            <div class="ans_form_row" style="padding: 0 0 0 15%">
                                <div class="g-recaptcha" data-sitekey="6LeafCIUAAAAAIs1TH0qbLiH4W2SunNkkshiSF0u"></div>
                            </div>
                            <div class="ans_form_row" style="padding: 0 0 0 15%">
                                <input class="registr_in_sub" name="submit" value="Отправить" type="submit" />
                            </div>
                            <div class="ans_form_row reg_error" id="reg_error" style="padding: 0 0 0 15%">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>