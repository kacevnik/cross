<?php

/**
 * @author kacevnik
 */
 
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
        $h = $h%24;
        if($h == 0){
           $h = ''; 
        }else{
 
            $h = " ".$h."ч."; 
        }
        return $h.$m.$s;
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
?>