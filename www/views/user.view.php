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
                                    <li data="lk_message">Сообщения</li>
                                    <li data="lk_my_cross">Мои кроссворды</li>
                                </ul>
                            </div>
                            <div class="lk_settings lk_tab_item" id="lk_settings">
                                <h3>Настройки</h3>
                            </div>
                            <div class="lk_message lk_tab_item" id="lk_message">
                                <h3>Сообщения</h3>
                                <div class="message_list" style="display: none;">
                                    <ul>
                                        <li>
                                            <div class="message_list_item d_1 message_bold">
                                                <div class="message_autor"><a href="">Administrator</a></div>
                                                <div class="message_name"><a href="">Название сообщения</a></div>
                                                <div class="message_item_menu">
                                                    <ul>
                                                        <li><a href="" title="Прчитать"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="" title="Почитано"><i class="fa fa-check-square-o"></i></a></li>
                                                        <li><a href="" title="Ответить"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="" title="Удалить"><i class="fa fa-trash-o"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>                                            
                                            <div class="message_list_item d_2">
                                                <div class="message_autor"><a href="">Administrator</a></div>
                                                <div class="message_name"><a href="">Название сообщения</a></div>
                                                <div class="message_item_menu">
                                                    <ul>
                                                        <li><a href="" title="Прчитать"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="" title="Почитано"><i class="fa fa-check-square-o"></i></a></li>
                                                        <li><a href="" title="Ответить"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="" title="Удалить"><i class="fa fa-trash-o"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>                                            
                                            <div class="message_list_item d_1">
                                                <div class="message_autor"><a href="">Administrator</a></div>
                                                <div class="message_name"><a href="">Название сообщения</a></div>
                                                <div class="message_item_menu">
                                                    <ul>
                                                        <li><a href="" title="Прчитать"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="" title="Почитано"><i class="fa fa-check-square-o"></i></a></li>
                                                        <li><a href="" title="Ответить"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="" title="Удалить"><i class="fa fa-trash-o"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>                                            
                                            <div class="message_list_item d-2">
                                                <div class="message_autor"><a href="">Administrator</a></div>
                                                <div class="message_name"><a href="">Название сообщения</a></div>
                                                <div class="message_item_menu">
                                                    <ul>
                                                        <li><a href="" title="Прчитать"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="" title="Почитано"><i class="fa fa-check-square-o"></i></a></li>
                                                        <li><a href="" title="Ответить"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="" title="Удалить"><i class="fa fa-trash-o"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>                                            
                                            <div class="message_list_item d_1">
                                                <div class="message_autor"><a href="">Administrator</a></div>
                                                <div class="message_name"><a href="">Название сообщения</a></div>
                                                <div class="message_item_menu">
                                                    <ul>
                                                        <li><a href="" title="Прчитать"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="" title="Почитано"><i class="fa fa-check-square-o"></i></a></li>
                                                        <li><a href="" title="Ответить"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="" title="Удалить"><i class="fa fa-trash-o"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
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