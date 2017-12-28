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
                        <?php if($_SESSION['admin'] == $proverka){ ?>
                        <div class="lk_body">
                            <div class="lk_menu">
                                <ul>
                                    <li class="activ" data="lk_settings">Настройки</li>
                                    <li data="lk_message">Сообщения <?php if($list_message['count'] > 0){ ?> <span class="count_message"><?php echo $list_message['count']; ?></span> <?php } ?></li>
                                    <li data="lk_my_cross">Мои кроссворды</li>
                                </ul>
                            </div>
                            <div class="lk_settings lk_tab_item" id="lk_settings">
                                <h3>Настройки</h3>
                            </div>
                            <div class="lk_message lk_tab_item" id="lk_message">
                                <h3>Сообщения</h3>
                                <!-- LIST MESSAGE -->
                                <div class="message_list">
                                    <?php if(count($list_message) > 1){ ?>
                                        <?php $count_list_message = 0; $d_class = 'd_1'; foreach ($list_message as $mess) { if($count_list_message != 0){ ?>
                                        <?php
                                            if($d_class == 'd_2'){$d_class = 'd_1';}else{$d_class = 'd_2';}
                                        ?>
                                        <div class="message_list_item d_1<?php if($mess['date_read'] == 0){ echo ' message_bold'; }else{ echo ''; } echo ' ' . $d_class; ?>"  data-hash="<?php echo $mess['hash']; ?>">
                                            <div class="message_autor"><a href=""><?php echo $mess['login_view']; ?></a></div>
                                            <div class="message_name"><a href=""><?php echo $mess['name']; ?></a></div>
                                            <div class="message_item_menu">
                                                <ul>
                                                    <li><a href="" title="Прочитать"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="" title="Прочитано"><i class="fa fa-check-square-o"></i></a></li>
                                                    <li><a href="" title="Ответить"><i class="fa fa-pencil"></i></a></li>
                                                    <li><a href="" title="Удалить"><i class="fa fa-trash-o"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="content_message_item" id="<?php echo $mess['hash']; ?>">
                                            <div class="content_message_item_header"><?php echo $mess['name']; ?></div>
                                            <div class="content_message_item_body"><?php echo $mess['message']; ?></div>
                                            <div class="content_message_item_footer">
                                                <div class="content_message_item_footer_left"><a href=""><?php echo $mess['login_view']; ?></a><i>(<?php echo getMainDate($mess['date_send']); ?>)</i></div>
                                                <div class="content_message_item_footer_right message_item_menu">
                                                    <ul>
                                                        <li><a href="" title="Ответить"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="" title="Удалить"><i class="fa fa-trash-o"></i></a></li>
                                                        <li><a href="" title="Пожаловаться"><i class="fa fa-frown-o"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }$count_list_message++; } ?>
                                    <?php } ?>
                                </div>
                                <!-- END LIST MESSAGE -->
                            </div>
                            <div id="comment_back_list">
                                <div id="add_comment_body">
                                    <a class="close_comment_window"><i class="fa fa-times"></i></a>
                                    <div class="content_message"></div>
                                </div>
                            </div>
                            <div class="lk_my_cross lk_tab_item" id="lk_my_cross">
                                <h3>Мои Кроссворды</h3>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>