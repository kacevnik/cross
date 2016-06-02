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

?>