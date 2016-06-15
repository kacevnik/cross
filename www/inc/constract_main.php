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

?>