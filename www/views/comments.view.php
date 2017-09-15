                        <div class="cross_comments">
                            <h3>Комментарии:</h3>
                            <a href="" class="add_comment">Добавить комментарий</a>
                            <!--
                            <div class="comment_list">
                                <div class="comment_item">
                                    <div class="comment_avatar">
                                        <a href="">
                                            <img src="" alt="">
                                        </a>
                                    </div>
                                    <div class="comment_body">
                                        <div class="comment_header">
                                            <div class="comment_header_body">
                                                <a href="">Kacevnik</a>
                                                <div class="add_date_comment">20. 10. 2014</div>
                                            </div>
                                        </div>
                                        <div class="comment_text">
                                            По своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.
                                        </div>
                                    </div>
                                </div>

                                <div class="comment_item">
                                    <div class="comment_avatar">
                                        <a href="">
                                            <img src="" alt="">
                                        </a>
                                    </div>
                                    <div class="comment_body">
                                        <div class="comment_header">
                                            <a href="">Kacevnik</a>
                                            <div class="add_date_comment">20. 10. 2014</div>
                                        </div>
                                        <div class="comment_text">
                                            По своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                        <div id="comment_back_list">
                            <div id="add_comment_body">
                                <a class="close_comment_window"><i class="fa fa-times"></i></a>
                                <h4>Добавить комментарий</h4>
                                <form action="post">
                                <?php if(!$idUser > 0){ ?>
                                    <input type="text" name="email_comment" placeholder="Укажите E-mail" style="margin: 0 0 15px 0;">
                                    <input type="text" name="name" placeholder="Укажите Ваше имя">
                                <?php } ?>
                                    <input type="hidden" name="id_user" value="<?php echo $idUser; ?>">
                                    <input type="hidden" name="id_cross" value="<?php echo $cross; ?>">
                                    <input type="hidden" name="hash_cross" value="<?php echo $crossData['img']; ?>">
                                    <textarea name="text_comment" cols="30" rows="10" placeholder="Введите комментарий"></textarea>
                                    <input type="submit" name="send_comment" class="registr_in_sub">
                                </form>
                                <div id="spin_comment"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
                                <div id="add_comment_ok">
                                    <p>
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    </p>
                                    <h4>
                                        Поздравляем!
                                    </h4>
                                    <p class="show_message_ok"></p>
                                </div>
                                <div id="comment_result_message"></div>
                            </div>
                        </div>