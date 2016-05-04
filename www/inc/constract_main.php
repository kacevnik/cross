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
 * Функция получения массива из базы данных для верхних чисел таблицы.
 **/

    function getArrayTop($id){
        global $db;
        $sql = "SELECT arr_top FROM dk_cross WHERE id='1'";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res)){
            $myr = mysqli_fetch_assoc($res);                
        }
        else{return false;}
        return $myr;
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
    //[[[0, 1], [0, 1], [10, 0]], [[0, 1], [3, 0], [2, 0]], [[0, 1], [2, 0], [1, 0]], [[0, 1], [1, 0], [4, 0]], [[1, 0], [1, 0], [5, 0]], [[1, 0], [2, 0], [2, 0]], [[0, 1], [1, 0], [6, 0]], [[0, 1], [0, 1], [8, 0]], [[0, 1], [0, 1], [6, 0]], [[0, 1], [0, 1], [4, 0]]]
?>