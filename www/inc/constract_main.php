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
 * Функция выборки данных кроссвордов для главной страницы.
 **/

    function getListCross($limit, $id_user = 0){
        global $db;
        $arr = array();
        $sql = "SELECT id,user_add_id,s_time,time_add,count_star,power,cross_w,cross_h,name FROM dk_cross WHERE type='1' ORDER BY id DESC LIMIT ".$limit;
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
 * Функция получения данных кроссворда из БД по ID.
 **/

    function getCrossData($id){
        global $db;
        if(!abs((int)$id))return false;
        $sql = "SELECT * FROM dk_cross WHERE id='$id' AND type='1' LIMIT 1";
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
 * функция добпалния картинки
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
                    $name_img = md5(microtime()).'.jpg';
                    mysqli_query($db, "UPDATE dk_cross SET img='$name_img' WHERE id='$id_cross'");
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
            $black = imagecolorallocate($img,255,255,255);
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

?>