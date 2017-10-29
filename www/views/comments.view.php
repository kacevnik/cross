<?php
    function getDataForCommentList($cross){
        global $db;
        $arr = array();
        $sql = "SELECT id_user,name_user,date_add,text_comment,metka FROM dk_comments WHERE id_cross='$cross' AND type='1' ORDER BY date_add DESC";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res) > 0){
            $myr = mysqli_fetch_assoc($res);
            do{
                $arr[] = $myr;
            }while($myr = mysqli_fetch_assoc($res));
            return $arr;
        }
        return false;
    }

?>


                       <div class="cross_comments">
                            <h3>Комментарии:</h3>
                            <a href="" class="add_comment">Добавить комментарий</a>
<?php if(getDataForCommentList($cross)){ ?>                            
                            <div class="comment_list">
<?php $arrComment = getDataForCommentList($cross); foreach ($arrComment as $itemComment) { ?>
                                <div class="comment_item">
                                    <div class="comment_avatar">
                                        <a href="http://samurai-ka.ru/user.php?id=<?php echo $itemComment['id_user']; ?>">
                                            <img src="" alt="">
                                        </a>
                                    </div>
                                    <div class="comment_body">
                                        <div class="comment_header">
                                            <div class="comment_header_body">
                                                <a href="http://samurai-ka.ru/user.php?id=<?php echo $itemComment['id_user']; ?>"><?php echo $itemComment['name_user']; ?></a>
                                                <div class="add_date_comment"><?php echo date("d. m. Y", $itemComment['date_add']); ?></div>
                                            </div>
                                        </div>
                                        <div class="comment_text">
                                            <?php echo $itemComment['text_comment']; ?>
                                        </div>
                                    </div>
                                </div>
<?php } ?>
                            </div>
<?php } ?>
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