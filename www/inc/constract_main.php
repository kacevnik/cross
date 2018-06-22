<?php

/**
* @author kacevnik
* @copyright 2016
*/

/**
* Функция вывода массива.
**/

    function print_arr($array){
        echo "<pre>".print_r($array, true)."</pre>";
    }

/**
* Получения из БД данных для среднешо значения рейтинга кроссворда
**/

    function getReitingStarCross($cross){
        global $db;
        $sql = "SELECT AVG(value) AS sum FROM dk_stars WHERE id_cross='$cross'";
        $res = mysqli_query($db, $sql);
        $myr = mysqli_fetch_assoc($res);
        return $sum = $myr['sum']*2;
    }

/**
* Функция для получения дат различных праздников. Формат вводимых данных D-M
* Входные аргументы STRING, второй параметр необязательно
**/

    function setHollyday($string_data_1, $string_data_2 = ''){
        if( $string_data_2 == '' ){
            if( $string_data_1 != date("j-n") ){
                return false;
            }
        }else{
            $date = $string_data_1;
            $arr_date = array($date);
            $day = explode('-', $string_data_1);
            $d = $day[0];
            $m = $day[1];
            $y = date("Y");
            $mk =  mktime(0, 0, 0, $m, $d, $y);
            do{
                $mk = $mk + 86400;
                $arr_date[] = date("j-n", $mk);
            }
            while ( $string_data_2 != date("j-n", $mk));
            if ( !in_array(date("j-n"), $arr_date) ){
                return false;
            }
        }
        return true;
    }

/**
* Функция очистки истории старый историй решения
**/

    function clerarHistory(){
        global $db;
        $t = TIMES;
        $sql = "SELECT id FROM solution WHERE date_clear_history>'0' AND date_clear_history<'$t' AND type='1' LIMIT 1";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);
            $id = $myr['id'];
            $up = mysqli_query($db, "UPDATE solution SET history='',date_clear_history='0',clear='0',sec_history='0' WHERE id='$id'");
            return true;
        }
    }

/**
* Функция получения из БД основных настроек сайта.
**/

     function getMainSetings(){
        global $db;
        $myr = array();
        $sql = "SELECT * FROM dk_set WHERE id='1' LIMIT 1";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);
        }
        else{return false;}
        return $myr;
    }

/**
* Функция получения данных определенной статьи для главной страницы.
**/

    function articleMainData($page = 1, $saze, $power){
        global $db;
        
        $arrTitle = array('small' => 'Маленькие японские кроссворды', 'medium' => 'Японские кроссворды средних размеров', 'big' => 'Большие японские кроссворды');
        $arrKeys = array('small' => 'маленькие японские кроссворды, японскин кроссворды маленького размера', 'medium' => 'японские кроссворды средних размеров, средние японские кроссворды', 'big' => 'большие японские кроссворды, японские кроссворды большого размера');
        $arrDis = array('small' => 'Здесь Вы можете решать и скачать маленькие японские кроссворды. Японские кроссворды маленького размера решаются довольно легко.', 'medium' => 'Здесь Вы можете решать и скачать средние японские кроссворды. Японские кроссворды среднего размера решаются довольно легко.', 'big' => 'Здесь Вы можете решать и скачать большие японские кроссворды. Японские кроссворды большого размера решаются довольно трудно.');
        
        $arrTitleP = array('simple' => 'Лёгкие японские кроссворды', 'normal' => 'Японские кроссворды средней сложности', 'hard' => 'Сложные японские кроссворды');
        $arrKeysP = array('simple' => 'легкие японские кроссворды, японскин кроссворды решать легко', 'normal' => 'японские кроссворды средней сложности, средние японские кроссворды', 'hard' => 'сложные японские кроссворды, японские кроссворды сложного решения, трудные японские кроссворды');
        $arrDisP = array('simple' => 'Здесь Вы можете решать и скачать легкие японские кроссворды.', 'normal' => 'Здесь Вы можете решать и скачать японские кроссворды средние сложности.', 'hard' => 'Здесь Вы можете решать и скачать сложные японские кроссворды. Сложные японские кроссворды решаются довольно трудно.');

        if($page != 1){$pageVeiw = ' - страница #'.$page;}
        $sql = "SELECT * FROM dk_articles WHERE is_main='1' AND type='1' AND date_show<'".TIMES."' LIMIT 1";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);
            if($saze != 'all'){
                $myr['title'] = $arrTitle[$saze].$pageVeiw;
                $myr['meta_keys'] = $arrKeys[$saze];
                $myr['dis'] = $arrDis[$saze].$pageVeiw;
            }
            if($power != 'all'){
                $myr['title'] = $arrTitleP[$power].$pageVeiw;
                $myr['meta_keys'] = $arrKeysP[$power];
                $myr['dis'] = $arrDisP[$power].$pageVeiw;
            } 
            if($saze == 'all' && $power = 'all' && $page != 1){
                $myr['title'] = $myr['title'].$pageVeiw;
                $myr['dis'] = $myr['dis'].$pageVeiw;
            }
        }
        else{return false;}
        return $myr;
    }

/**
* Функция получения данных определенной статьи из БД по ID.
**/

    function getArticleData($id){
        global $db;
        if(!abs((int)$id))return false;
        $sql = "SELECT * FROM dk_articles WHERE id='$id' AND type='1' AND date_show<'".TIMES."' LIMIT 1";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);
        }
        else{return false;}
        return $myr;
    }

/**
* Получение массива в тремя размерами кроссвордов
**/

    function getAllSize(){
        global $db;
        $arr = array();
        $arr['small'] = " AND size > '0' AND size <= '225'";
        $arr['medium'] = " AND size > '225' AND size <= '1225'";
        $arr['big'] = " AND size > '1225'";
        $arr['all'] = " AND size > '0'";
        return $arr;
    }

/**
* Получение массива в тремя Вариантами сложности для будущего составления запроса к базе данных и соортировки соответствующего запроса.
**/

    function getAllPower(){
        global $db;
        $arr = array();
        $arr['simple'] = " AND power >= '0' AND power <= '4'";
        $arr['normal'] = " AND power > '4' AND power <= '7'";
        $arr['hard'] = " AND power > '7'";
        $arr['all'] = " AND power >= '0'";
        return $arr;
    }

/**
* Функция выборки данных кроссвордов для главной страницы.
**/

    function getListCross($limit, $array_sql_size, $array_sql_power, $id_user = 0, $page = 1, $size = 'all', $power = 'simple'){
        global $db;
        $arr = array();
        $start = $page * $limit - $limit;
        $sql = "SELECT id,user_add_id,s_time,time_add,count_star,power,cross_w,cross_h,name,img FROM dk_cross WHERE time_of_public<'".TIMES."' AND type='1'".$array_sql_size[$size].$array_sql_power[$power]." ORDER BY time_of_public DESC LIMIT ".$start.", ".$limit;
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);
            do{
                $id = $myr['id'];
                $sql_2 = "SELECT type FROM solution WHERE id_cross='$id' AND id_user='$id_user' AND type='1'";
                $res_2 =  mysqli_query($db, $sql_2);
                if(mysqli_num_rows($res_2) > 0){
                    $myr['type'] = 1;
                }else{
                    $myr['type'] = 0;
                }
                $arr[] = $myr;  
            }while($myr = mysqli_fetch_assoc($res));
        }
        else{return false;}
        return $arr;
    }

/**
* Функция получения общего количества запрашиваемый крссвордов.
**/

    function getTotalCountCross($array_sql_size, $array_sql_power,$size = 'all', $power = 'simple'){
        global $db;
        $sql = "SELECT id FROM dk_cross WHERE time_of_public<'".TIMES."' AND type='1'".$array_sql_size[$size].$array_sql_power[$power];
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            return $total = mysqli_num_rows($res);
        }else{return false;}
    }

/**
* Функция получения списка статей для категории из БД по ID.
**/

    function getListArticles($id, $limit, $page = 1){
        global $db;
        $arr = array();
        $start = $page * $limit - $limit;
        if(!abs((int)$id))return false;
        $sql = "SELECT * FROM dk_articles WHERE category_id='$id' AND type='1' AND date_show<'".TIMES."' ORDER BY date_show DESC LIMIT ".$start.", ".$limit;
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res); 
            do{
               $arr[] = $myr;
            }
            while($myr = mysqli_fetch_assoc($res));
        }
        else{return false;}
        return $arr;
    }

/**
* Функция получения общего количества статей для категории из БД по ID.
**/

    function getTotalCategory($id_cat){
        global $db;
        if(!abs((int)$id_cat))return false;
        $sql = "SELECT * FROM dk_articles WHERE category_id='$id_cat' AND type='1' AND date_show<'".TIMES."'";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $total = mysqli_num_rows($res);
        }
        else{return false;}
        return $total;
    }

/**
* Функция получения данных о категории по ID категории.
**/

    function getDataCategory($id_cat){
        global $db;
        if(!abs((int)$id_cat))return false;
        $sql = "SELECT * FROM dk_cat WHERE id='$id_cat' LIMIT 1";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);
        }
        else{return false;}
        return $myr;
    }

/**
* Функция получения данных кроссворда из БД по ID.
**/

    function getCrossData($id){
        global $db;
        if(!abs((int)$id))return false;
        $sql = "SELECT * FROM dk_cross WHERE id='$id' AND type='1' AND time_of_public<'".TIMES."' LIMIT 1";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);
        }
        else{return false;}
        return $myr;
    }

/**
* Функция получения данных кроссворда из БД по ID вариант 2.
**/

    function getCrossData2($id){
        global $db;
        if(!abs((int)$id))return false;
        $sql = "SELECT * FROM dk_cross WHERE id='$id' LIMIT 1";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);
        }
        else{return false;}
        return $myr;
    }

/**
* Функция получения данных кроссворда из БД по ID.
**/

    function getCountSolution($cross){
        global $db;
        $sql = "SELECT id FROM solution WHERE id_cross='$cross' AND type='1'";
        $res = mysqli_query($db, $sql);

        return mysqli_num_rows($res);
    }

/**
 * Функция преобразования строки в удобную строку.
 **/

    function strReplase($string){
        $string = str_replace('+','[',$string);
        $string = str_replace('-',']',$string);
        return $string;
    }

/**
* Функция получения логина пользователя по ID.
**/

    function getLoginName($id){
        global $db;
        $sql = "SELECT login_view FROM dk_user WHERE id='$id' AND metka='1' LIMIT 1";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);
            $s = $myr['login_view'];
        }
        else{return 111;}
        return $s;
    }

/**
* Функция изменеия окончания слова.
**/

    function numberEnd($number, $titles) {
        $cases = array (2, 0, 1, 1, 1, 2);
        return $titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
    }

/**
* Функция преобразования строки в двумерный массив.
**/

    function strToArr($string){
        $string = rtrim($string, ']]]');
        $string = ltrim($string, '[[[');
        $arr = explode(']], [[', $string);
        for($i = 0; $i < count($arr); $i++){
            $arr[$i] = explode('], [', $arr[$i]);
            for($j = 0; $j < count($arr[$i]); $j++){
                $arr[$i][$j] = explode(', ', $arr[$i][$j]);
            }
        }
        return $arr;
    }

/**
* функция выборки лучшего времени для кроссворда
**/

    function bestTime($cross){
        global $db;
        $arr = array();
        $sql = "SELECT id_user,sol_time FROM solution WHERE id_cross='$cross' AND type='1' ORDER BY sol_time LIMIT 1";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);
            $arr[] =  $myr['id_user'];
            $arr[] =  $myr['sol_time'];
        }
        else{return false;}
        return $arr;
    }

/**
* функция отображения звезд рейтига и сложности
**/

    function showStars($num){
        for($i = 0; $i < 5; $i++){
            if($num/2 >= 1 && $num/2 > 0){
                $res.= '<span class="icon-star-full c_orange"></span>';
                $num-=2;
            }else if($num/2 < 1 && $num/2 > 0){ 
                $res.= '<span class="icon-star-half c_orange"></span>';
                $num-=2;
            }else{
                $res.= '<span class="icon-star-empty c_orange"></span>';
                $num-=2;
            }
        }
        return $res;
    }

/**
* функция добавления картинки
**/

    function creat_and_add_images($id_cross, $sol=false){
        global $db;
        $dir = '../img_cross/';
        $res = mysqli_query($db, "SELECT cross_w,cross_h,arr_top,arr_left,otvet,img FROM dk_cross WHERE id='$id_cross'");
        if(mysqli_num_rows($res) > 0){
            $myr = mysqli_fetch_assoc($res);
            
            $top_string = strReplase($myr[arr_top]);
            $left_string = strReplase($myr[arr_left]);
            $arr_top = strToArr($top_string);
            $arr_left = strToArr($left_string);
            $solution = str_split($myr['otvet']);
            if($sol){
                $name_img = $myr['img'];
                if($name_img == ''){
                    $name_img = md5(microtime());
                    mysqli_query($db, "UPDATE dk_cross SET img='$name_img' WHERE id='$id_cross'");
                    $name_img.='.jpg';
                }
                else{
                    $name_img.='.jpg';
                }   
            }else{
                $name_img = $id_cross.'.jpg';
            }
            $save_pach_images = $dir.$name_img;
            
            $width = $myr['cross_w'] * 2 + 6 +(count($arr_left[0]) * 2 - 2);  //Ширина
            $height = $myr['cross_h'] * 2 + 6 + (count($arr_top) * 2 - 2);  //Высота

            $img = imagecreatetruecolor($width,$height); //Создает картинку
            //Цвета//
        
            $white = imagecolorallocate($img,255,255,255);
            $black = imagecolorallocate($img,0,0,0);
            $grey_1 = imagecolorallocate($img,143,143,143); //Серый цвет для рамки
            $grey_2 = imagecolorallocate($img,215,215,215); //Серый цвет для углового поля
            $grey_3 = imagecolorallocate($img,176,176,176); //Серый цвет для сетки в полях для чисел
            $grey_4 = imagecolorallocate($img,210,210,210); //Серый цвет для сетки в основном поле
            $grey_5 = imagecolorallocate($img,180,180,180); //Серый цвет для сетки пятерки
            $grey_6 = imagecolorallocate($img,46,46,46);    //Темно серый для цифр
            $grey_7 = imagecolorallocate($img,90,90,90);    //Темно серый для разделителей между цифрами

            imagefill($img, 0, 0, $white);
            //Горизонтальные линии в верхней части
            $y1 = 3;
            $x1 = count($arr_left[0]) * 2 - 1 + 4;
            for($i = 0; $i < count($arr_top) - 1; $i++){
                imageline($img, $x1, $y1, $width, $y1,  $grey_3);
                $y1+=2;
            }
            //Вертикальные линии в верхней части
            $x1 = count($arr_left[0]) * 2 - 1 + 5;
            for($i = 0; $i < $myr['cross_w']; $i++){
                if(($i + 1) % 5 == 0){
                    imageline($img, $x1, 0, $x1, count($arr_top) * 2 + 1,  $grey_1);
                }else{
                    imageline($img, $x1, 0, $x1, count($arr_top) * 2 + 1,  $grey_3);
                }
                $x1+=2;
            }
            //Вертикальные линии в боковой части
            $y2 = count($arr_top) * 2 + 2;
            $x2 = 3;
            for($i = 0; $i < count($arr_left[0]) - 1; $i++){
                imageline($img, $x2, $x2, $x2, $height,  $grey_3);
                $x2+=2;
            }
            //Горизонатальные линии в боковой части
            $y2 = count($arr_top) * 2 - 1 + 5;
            $x2 = 0;
            for($i = 0; $i < $myr['cross_h']; $i++){
                if(($i + 1) % 5 == 0){
                    imageline($img, $x2, $y2, count($arr_left[0]) * 2 + 1, $y2,  $grey_1);
                }else{
                    imageline($img, $x2, $y2, count($arr_left[0]) * 2 + 1, $y2,  $grey_3);
                }
                $y2+=2;
            }
            //Горизонатальные линии в основном поле
            $x3 = count($arr_left[0]) * 2 + 3;
            $y3 = count($arr_top) * 2 + 4;
            for($i = 0; $i < $myr['cross_h'] - 1; $i++){
                if(($i + 1) % 5 == 0){
                    imageline($img, $x3, $y3, $width - 1, $y3,  $grey_5);
                }else{
                    imageline($img, $x3, $y3, $width - 1, $y3,  $grey_4);
                }
                $y3+=2;
            }
            //Вертикальные линии в основном поле
            $x3 = count($arr_left[0]) * 2 + 4;
            $y3 = count($arr_top) * 2 + 3;
            for($i = 0; $i < $myr['cross_w'] - 1; $i++){
                if(($i + 1) % 5 == 0){
                    imageline($img, $x3, $y3, $x3, $height - 1,  $grey_5);
                }else{
                    imageline($img, $x3, $y3, $x3, $height - 1,  $grey_4);
                }
                $x3+=2;
            }
            //горизонатальные линии-пятерки в основном поле
            $x3 = count($arr_left[0]) * 2 + 3;
            $y3 = count($arr_top) * 2 + 4;
            for($i = 0; $i < $myr['cross_h'] - 1; $i++){
                if(($i + 1) % 5 == 0){
                    imageline($img, $x3, $y3, $width - 1, $y3,  $grey_5);
                }
                $y3+=2;
            }

            imagerectangle($img, 0, 0, $width -1, $height -1, $grey_1);//Внешняя рамка
            imagerectangle($img, 1, 1, $width -2, $height -2, $grey_1);//Внутренняя рамка
            imageFilledrectangle($img, 2, 2, count($arr_left[0]) * 2, count($arr_top) * 2, $grey_2);

            //Закраска полей слева
            $x4 = 1;
            $y4 = count($arr_top) * 2 + 3;
            for($i = 0; $i < count($arr_left);$i++){
                for($j = 0;$j < count($arr_left[$i]);$j++){
                    if($arr_left[$i][$j][0] != 'n'){
                        imagesetpixel($img, $x4 + $j *2, $y4 + $i * 2, $grey_6);
                        imagesetpixel($img, $x4 + $j * 2 + 1, $y4 + $i * 2, $grey_6);
                        if($i != 0){
                            if($i%5 == 0){
                                imagesetpixel($img, $x4 + $j * 2 + 1, $y4 + $i * 2 - 1, $grey_7);
                                imagesetpixel($img, $x4 + $j * 2, $y4 + $i * 2 - 1, $grey_7);
                            }else{
                                imagesetpixel($img, $x4 + $j * 2 + 1, $y4 + $i * 2 - 1, $grey_6);
                                imagesetpixel($img, $x4 + $j * 2, $y4 + $i * 2 - 1, $grey_6);
                            }
                        }
                    }
                }
            }

            //Закраска полей сверху
            $x4 = count($arr_left[0]) * 2 + 3;
            $y4 = 2;
            for($i = 0; $i < count($arr_top);$i++){
                for($j = 0;$j < count($arr_top[$i]);$j++){
                    if($arr_top[$i][$j][0] != 'n'){
                        imagesetpixel($img, $x4 + $j * 2, $y4 + $i * 2, $grey_6);
                        imagesetpixel($img, $x4 + $j * 2, $y4 + $i * 2 - 1, $grey_6);
                        if($j != 0){
                            if($j%5 == 0){
                                imagesetpixel($img, $x4 + $j * 2 - 1, $y4 + $i * 2 - 1, $grey_7);
                                imagesetpixel($img, $x4 + $j * 2 - 1, $y4 + $i * 2, $grey_7);
                            }else{
                                imagesetpixel($img, $x4 + $j * 2 - 1, $y4 + $i * 2 - 1, $grey_6);
                                imagesetpixel($img, $x4 + $j * 2 - 1, $y4 + $i * 2, $grey_6);
                            }
                        }
                    }
                }
            }

            if($sol){
                //Закраска полей ответа
                $countSol = 0;
                $x5 = count($arr_left[0]) * 2 + 3;
                $y5 = count($arr_top) * 2 + 3;
                for($i = 0; $i < $myr['cross_h']; $i++){
                    for($j = 0; $j < $myr['cross_w']; $j++){
                        if($solution[$countSol] == 1){
                            imagesetpixel($img, $x5 + $j * 2, $y5 + $i * 2, $grey_6);
                            imagesetpixel($img, $x5 + $j * 2 - 1, $y5 + $i * 2, $grey_6);
                            imagesetpixel($img, $x5 + $j * 2 - 1, $y5 + $i * 2 - 1, $grey_6);
                            imagesetpixel($img, $x5 + $j * 2, $y5 + $i * 2 - 1, $grey_6);
                        }
                        $countSol++;
                    }
                }
            }

            imageline($img, count($arr_left[0]) * 2 + 1, 0, count($arr_left[0]) * 2 + 1, $height, $grey_1);
            imageline($img, count($arr_left[0]) * 2 + 2, 0, count($arr_left[0]) * 2 + 2, $height, $grey_1);
            imageline($img, 0, count($arr_top) * 2 + 1, $width, count($arr_top) * 2 + 1, $grey_1);
            imageline($img, 0, count($arr_top) * 2 + 2, $width, count($arr_top) * 2 + 2, $grey_1);
            
            header("Content-type: image/jpeg"); //Задаем заголовок для вывода картинки
            
            imagejpeg($img, $save_pach_images, 100); //Вывод картинки

        }
    }

/**
* функция добавления картинки для ответа
**/

    function creat_and_add_images_answer($id_cross){ 
        global $db;
        $dir = '../img_cross/'; //папка сохраниния картинки
 
        $res = mysqli_query($db, "SELECT cross_w,cross_h,arr_top,arr_left,otvet,img FROM dk_cross WHERE id='$id_cross'");
        if(mysqli_num_rows($res) > 0){
            $myr = mysqli_fetch_assoc($res);
            
            $top_string = strReplase($myr[arr_top]);
            $left_string = strReplase($myr[arr_left]);
            $arr_top = strToArr($top_string);
            $arr_left = strToArr($left_string);
            $solution = str_split($myr['otvet']);
            $name_img = $myr['img'];
            if($name_img == ''){
                $name_img = md5(microtime());
                mysqli_query($db, "UPDATE dk_cross SET img='$name_img' WHERE id='$id_cross'");
                $name_img.='_ans.jpg';
            }
            else{
                $name_img.='_ans.jpg';
            } 

            $save_pach_images = $dir.$name_img;//путь сохранения картинки

            $width = $myr['cross_w'] * 13 + 4 +(count($arr_left[0]) * 13) + (ceil($myr['cross_w']/5) - 1);  //Ширина
            $height = $myr['cross_h'] * 13 + 4 + (count($arr_top) * 13 + (ceil($myr['cross_h']/5) - 1));  //Высота

            $img = imagecreatetruecolor($width,$height); //Создает картинку

            //Цвета//
            $white = imagecolorallocate($img,255,255,255);
            $black = imagecolorallocate($img,0,0,0);
            $grey_1 = imagecolorallocate($img,143,143,143); //Серый цвет для рамки
            $grey_2 = imagecolorallocate($img,215,215,215); //Серый цвет для углового поля
            $grey_3 = imagecolorallocate($img,176,176,176); //Серый цвет для сетки в полях для чисел
            $grey_4 = imagecolorallocate($img,210,210,210); //Серый цвет для сетки в основном поле
            $grey_5 = imagecolorallocate($img,180,180,180); //Серый цвет для сетки пятерки
            $grey_6 = imagecolorallocate($img,46,46,46);    //Темно серый для цифр
            $grey_7 = imagecolorallocate($img,90,90,90);    //Темно серый для разделителей между цифрами
            $font = '../style/fonts/arial.ttf';

            imagefill($img, 0, 0, $white);

            imageFilledrectangle($img, 2, 2, count($arr_left[0]) * 13, count($arr_top) * 13, $grey_2);//Угловой прямоугольник

            //Водный знак названия
            for($g=0; $g < 600; $g++){
                if($g == 0){
                        $p_x = 0;
                        $p_y = 0;
                        $f_x = $p_x -29;
                        $f_y = $p_y + 45;
                }else{
                    if($r_x >= (count($arr_left[0]) * 13 + 3)){
                        $p_x = $f_x;
                        $p_y = $f_y;
                        $f_x -= ceil(($l_y - $l_x)/2);
                        $f_y += 45;
                    }
                    else{
                        $p_x = $r_x + 2;
                        $p_y = $r_y - 2;
                    }
                }
                    $box1 = imagettftext($img, 10, 45, $p_x, $p_y, $white, $font, TITLE_SITE);
                    $box2 = imagettftext($img, 10, 45, $p_x -1, $p_y -1, $black, $font, TITLE_SITE);
                    $r_x = $box1[2];
                    $r_y = $box1[3];
                    $l_x = $box1[6];
                    $l_y = $box1[4];
            }

            imageFilledrectangle($img, 2, count($arr_top) * 13 + 3, $width, $height, $white);//прямоугольник закраски белым
            imageFilledrectangle($img, count($arr_left[0]) * 13 + 3, 2, $width, $height, $white);//прямоугольник закраски белым

            //Горизонтальные линии в верхней части
            $y1 = 14;
            $x1 = count($arr_left[0]) * 13 + 3;
            for($i = 0; $i < count($arr_top) - 1; $i++){
                imageline($img, $x1, $y1, $width, $y1,  $grey_1);
                $y1+=13;
            }
            
            //Вертикальные линии в верхней части
            $y1 = 2;
            $x1 = count($arr_left[0]) * 13 + 15;
            for($i = 0; $i < $myr['cross_w']; $i++){
                if(($i + 1) % 5 == 0){
                    imageline($img, $x1, $y1, $x1, count($arr_top) * 13 + 1,  $grey_1);
                    $x1+=1;
                    imageline($img, $x1, $y1, $x1, count($arr_top) * 13 + 1,  $grey_1);
                }else{
                    imageline($img, $x1, $y1, $x1, count($arr_top) * 13 + 1,  $grey_1);
                }
                $x1+=13;
            }

            //Вертикальные линии в боковой части
            $y2 = count($arr_top) * 13 + 3;
            $x2 = 14;
            for($i = 0; $i < count($arr_left[0]) - 1; $i++){
                imageline($img, $x2, $y2, $x2, $height,  $grey_1);
                $x2+=13;
            }

            //Горизонатальные линии в боковой части
            $y2 = count($arr_top) * 13 +15;
            $x2 = 0;
            for($i = 0; $i < $myr['cross_h']; $i++){
                if(($i + 1) % 5 == 0){
                    imageline($img, $x2, $y2, count($arr_left[0]) * 13 + 1, $y2,  $grey_1);
                    $y2+=1;
                    imageline($img, $x2, $y2, count($arr_left[0]) * 13 + 1, $y2,  $grey_1);
                }else{
                    imageline($img, $x2, $y2, count($arr_left[0]) * 13 + 1, $y2,  $grey_1);
                }        
                $y2+=13;
            }

            //Горизонатальные линии в основном поле
            $x3 = count($arr_left[0]) * 13 + 3;
            $y3 = count($arr_top) * 13 + 15;
            for($i = 0; $i < $myr['cross_h'] - 1; $i++){
                if(($i + 1) % 5 == 0){
                    imageline($img, $x3, $y3, $width - 2, $y3,  $grey_3);
                    $y3+=1;
                    imageline($img, $x3, $y3, $width - 2, $y3,  $grey_3);
                }else{
                    imageline($img, $x3, $y3, $width - 2, $y3,  $grey_2);
                }
                $y3+=13;
            }

            //Вертикальные линии в основном поле
            $x3 = count($arr_left[0]) * 13 + 15;
            $y3 = count($arr_top) * 13 + 3;
            for($i = 0; $i < $myr['cross_w'] - 1; $i++){
                if(($i + 1) % 5 == 0){
                    imageline($img, $x3, $y3, $x3, $height - 2,  $grey_3);
                    $x3+=1;
                    imageline($img, $x3, $y3, $x3, $height - 2,  $grey_3);
                }else{
                    imageline($img, $x3, $y3, $x3, $height - 2,  $grey_3);
                }
                $x3+=13;
            }

            //Закраска полей слева
            $x4 = 2;
            $y4 = count($arr_top) * 13 + 2;
            for($i = 0; $i < count($arr_left);$i++){
                if($i%5 == 0){$y4++;}
                for($j = 0;$j < count($arr_left[$i]);$j++){
                    if($arr_left[$i][$j][0] != 'n'){
                        imageFilledrectangle($img, $x4 + $j * 13, $y4 + $i * 13, $x4 + $j * 13 + 11, $y4 + $i * 13 + 11, $grey_2);
                        if($arr_left[$i][$j][0] > 9){$x6 = $x4 + $j * 13;}else{$x6 = $x4 + $j * 13 + 4;} 
                        imagettftext($img, 7, 0, $x6, $y4 + $i * 13 + 10, $black, $font, $arr_left[$i][$j][0]);
                    }
                }
            }

            //Закраска полей сверху
            $x4 = count($arr_left[0]) * 13 + 2;
            $y4 = 2;
            for($i = 0; $i < count($arr_top);$i++){
                for($j = 0;$j < count($arr_top[$i]);$j++){
                if($j%5 == 0){$x4++;}
                    if($arr_top[$i][$j][0] != 'n'){
                        imageFilledrectangle($img, $x4 + $j * 13, $y4 + $i * 13, $x4 + $j * 13 + 11, $y4 + $i * 13 + 11, $grey_2);
                        if($arr_top[$i][$j][0] > 9){$x6 = $x4 + $j * 13;}else{$x6 = $x4 + $j * 13 + 4;} 
                        imagettftext($img, 7, 0, $x6, $y4 + $i * 13 + 10, $black, $font, $arr_top[$i][$j][0]);
                    }
                }
                $x4 = count($arr_left[0]) * 13 + 2;
            }

            //Закраска полей ответа
            $countSol = 0;
            $x5 = count($arr_left[0]) * 13 + 2;
            $y5 = count($arr_top) * 13 + 2;
            for($i = 0; $i < $myr['cross_h']; $i++){
                if($i%5 == 0){$y5++;}
                for($j = 0; $j < $myr['cross_w']; $j++){
                    if($j%5 == 0){$x5++;}
                    if($solution[$countSol] == 1){
                        imageFilledrectangle($img, $x5 + $j * 13, $y5 + $i * 13, $x5 + $j * 13 + 11, $y5 + $i * 13 + 11, $black);
                    }
                    $countSol++;
                }
                $x5 = count($arr_left[0]) * 13 + 2;
            }
    
            imageline($img, count($arr_left[0]) * 13 + 1, 0, count($arr_left[0]) * 13 + 1, $height, $black);
            imageline($img, count($arr_left[0]) * 13 + 2, 0, count($arr_left[0]) * 13 + 2, $height, $black);
            imageline($img, 0, count($arr_top) * 13 + 1, $width, count($arr_top) * 13 + 1, $black);
            imageline($img, 0, count($arr_top) * 13 + 2, $width, count($arr_top) * 13 + 2, $black);
            imagerectangle($img, 0, 0, $width -1, $height -1, $black);//Внешняя рамка
            imagerectangle($img, 1, 1, $width -2, $height -2, $black);//Внутренняя рамка

            header("Content-type: image/jpeg"); //Задаем заголовок для вывода картинки
            
            imagejpeg($img, $save_pach_images, 100); //Вывод картинки
        
        }
    }
?>