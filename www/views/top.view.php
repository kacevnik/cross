    <div class="top">
        <div class="center">
            <div class="top-left"><?=dateTop(TIMES)?></div>
                <ul class="login-top">
                    <?php if(!$_SESSION['admin']){ ?>
                    <li><a href="login.php">Вход</a></li>
                    <li><a href="registr.php">Регистрация</a></li>                    
                    <?php }else{ ?>
                    <li><a href="user.php?id=<?php echo getIdFromSes($_SESSION['admin']);?>">Кабинет</a></li>
                    <li><a href="logout.php">Выход</a></li>
                    <?php } ?>
                </ul>
        </div>
    </div>