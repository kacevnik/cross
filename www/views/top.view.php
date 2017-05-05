<?php if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();} ?>   
    <div class="main">
        <div id="error_bg"><span></span></div>
        <div id="error_message">
                <div id="error_close"></div>
                <div id="error_message_text"></div>
        </div>
        <div class="top">
            <div class="center">
                <div class="top-left"><?=dateTop(TIMES)?></div>
                    <ul class="login-top">
                        <?php if(!$_SESSION['admin']){ ?>
                        <li><a href="login.php">Вход</a></li>
                        <li><a href="registr.php">Регистрация</a></li>                    
                        <?php }else{ ?>
                        <li><span class="top_login_name">(<?=getLoginFromSes($_SESSION['admin'])?>)</span></li>
                        <li><a href="user.php?id=<?php echo getIdFromSes($_SESSION['admin']);?>">Кабинет</a></li>
                        <li><a href="logout.php">Выход</a></li>
                        <?php } ?>
                    </ul>
            </div>
        </div>