<?php

/**
 * @author kacevnik
 */
 

/**
 * Функция получения массива с сохраненым ответом
 */
 
    function getArrayHistory($history){
        $arr = array();
        if($history != ''){
            return $arr = str_split($history);
        }else{
            return $arr;
        }
    }

 
/**
 * Функция сравнения ответа кроссворда и запрашиваемого решения. Возвращает процени совпадения решений
 */
 
    function getAnswerProcent($answer, $otwet){
        $str1 = str_split($answer);
        $str2 = str_split($otwet);
        $count = count($str1);
        $procent = 0;
        $count_procent = 0;
        for($i = 0; $i < $count; $i++){
            if($str2[$i] == 1){
                $count_procent++;
            }
        }
        $one_procent = $count_procent/100;
        for($i = 0; $i < $count; $i++){
            if($str1[$i] == $str2[$i] and $str2[$i] == 1){
                $procent++;
            }
            else if($str1[$i] != $str2[$i] and $str2[$i] != 1){
                $procent--;
            }
        }
        if($procent > 0){
           return round($procent/$one_procent); 
        }else{
            return 0;
        }
        
    }

 
/**
 * Функция даты и времени в верхней части сайта.
 */
 
    function dateTop($time){
        $month = array('янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек');
        $wick = array('Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб');
        return date("d ", $time).$month[date("n", $time)-1]." ".date("Y ", $time).$wick[date("w", $time)].".";
    }

/**
 * Основная Функция даты и времени. 06 ноя 1982 04:42
 */
 
    function getMainDate($time){
        $month = array('янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек');
        return date("d ", $time).$month[date("n", $time)-1]." ".date("Y ", $time).date(" H:i", $time);
    }
 
 
/**
* Основная Функция даты и времени. 06 ноя 1982
*/
 
    function getShotDate($time){
        $month = array('янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек');
        return date("d ", $time).$month[date("n", $time)-1]." ".date("Y ", $time);
    }
 
/**
* функция приведения количества секунд к нормальному времени
*/
 
    function getCountSec($count){
        $s = $count%60;
        if($s == 0){
            $s = '';
        }else{
            $s = " ".$s."с.";    
        }
                
        $m = floor($count/60);
        $m = $m%60;
        if($m == 0){
           $m = ''; 
        }else{
            $m = " ".$m."м."; 
        }
        
        $h = floor($count/60/60);
        if($h == 0){
           $h = ''; 
        }else{
 
            $h = " ".$h."ч."; 
        }
        return $h.$m.$s;
    }

/**
* функция приведения количества секунд к нормальному времени в таймере
*/
 
    function getCountSecTimer($count){
        if($count == 0){return '00:00:00';}
        $s = $count%60;
        if($s == 0){
            $s = '00';
        }else{
            if($s < 10){
                $s = '0'.$s;    
            }else{
                $s = $s;
            }    
        }
                
        $m = floor($count/60);
        $m = $m%60;
        if($m == 0){
           $m = '00'; 
        }else{
            if($m < 10){
                $m = '0'.$m;    
            }else{
                $m = $m;
            } 
        }
        
        $h = floor($count/60/60);
        if($h == 0){
           $h = '00'; 
        }else{
            if($m < 10){
                $h = '0'.$h;    
            }else{
                $h = $h;
            } 
        }
        return $h.':'.$m.':'.$s;
    }
    
/**
* Получения ID пользователя из ссесии
*/
 
    function getIdFromSes($session){
        global $db;
        $passProverka = substr($session, 0, 32);
        $kodProverka = substr($session, 32, 32);
        $sql = "SELECT id FROM dk_user WHERE pass='$passProverka' AND kod='$kodProverka' AND metka='1'";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res) > 0){
            $myr = mysqli_fetch_assoc($res);
            return $id = $myr["id"];
        }
    }
    
 /**
* Получения LoginName пользователя из ссесии
*/
 
    function getLoginFromSes($session){
        global $db;
        $passProverka = substr($session, 0, 32);
        $kodProverka = substr($session, 32, 32);
        $sql = "SELECT login_view FROM dk_user WHERE pass='$passProverka' AND kod='$kodProverka' AND metka='1'";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res) > 0){
            $myr = mysqli_fetch_assoc($res);
            return $id = $myr["login_view"];
        }
    }
?>