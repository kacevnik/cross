<?php
    include("inc/core.php");
    
    if(isset($_GET['id'])){$id = $_GET['id']; $id = (int)abs($id);}

    if($id){   
        $res = mysqli_query($db, "SELECT cross_w,cross_h,arr_top,arr_left,otvet FROM dk_cross WHERE id='$id'");
        if(mysqli_num_rows($res) > 0){
            $myr = mysqli_fetch_assoc($res);
            
            $top_string = strReplase($myr[arr_top]);
            $left_string = strReplase($myr[arr_left]);
            $arr_top = strToArr($top_string);
            $arr_left = strToArr($left_string);
            $solution = str_split($myr['otvet']);
            
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
    $font = 'style/fonts/arial.ttf';
    
    imagefill($img, 0, 0, $white);
    
    imageFilledrectangle($img, 2, 2, count($arr_left[0]) * 13, count($arr_top) * 13, $grey_2);//Угловой прямоугольник
    
    //Водный знак названия 
    for($g=0; $g < 200; $g++){
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
    imagerectangle($img, 0, 0, $width -1, $height -1, $black);//Внешняя рамка
    imagerectangle($img, 1, 1, $width -2, $height -2, $black);//Внутренняя рамка
    
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
                if($arr_left[$i][$j][0] > 9){$x6 = $x4 + $j * 13 + 1;}else{$x6 = $x4 + $j * 13 + 4;} 
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
                if($arr_top[$i][$j][0] > 9){$x6 = $x4 + $j * 13 + 1;}else{$x6 = $x4 + $j * 13 + 4;} 
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
    
    header("Content-type: image/jpeg"); //Задаем заголовок для вывода картинки
    
    imagejpeg($img, null, 100); //Вывод картинки
    
        }
    }
?>