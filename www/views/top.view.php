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
                        <li><a href="best.php"><i class="fa fa-trophy"></i></a></li>
                        <li><a href="" id="but_search_header"><i class="fa fa-search"></i></a></li>
                        <?php } ?>
                    </ul>
                    <div class="search_form_header">
                        <form action="">
                            <input type="text" placeholder="Найти кроссворд по названию ..." name="search_input" id="search_input">
                        </form>
                        <div id="search_result">
                            <ul></ul>
                        </div>
                    </div>
            </div>
        </div>
        <?php if(setHollyday('15-12', '15-1')){ ?>
        <div class="branch_hny"></div>
        <?php } ?>