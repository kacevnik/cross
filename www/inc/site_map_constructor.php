<?php

    function getSiteMap($array){
        if($array['date_site_map'] < TIMES){
            global $db;
            $arr = array();
            $arrSmall = array();
            $arrMed = array();
            $arrBig = array();
            $arrSimple = array();
            $arrNorm = array();
            $arrHard = array();
            $engine_root = $_SERVER['DOCUMENT_ROOT'];
            $sql = "SELECT id,size,power FROM dk_cross WHERE type='1' AND time_of_public<'".TIMES."'";
            $res = mysqli_query($db, $sql);
            if(mysqli_num_rows($res)){
                $myr = mysqli_fetch_assoc($res);                
                do{
                    $arr[] =  $myr;
                    if($myr['size'] > 0 && $myr['size'] <= 225){
                        $arrSmall[] = $myr;
                    }
                    if($myr['size'] > 225 && $myr['size'] <= 1225){
                        $arrMed[] = $myr;
                    } 
                    if($myr['size'] > 1225){
                        $arrBig[] = $myr;
                    } 
                    if($myr['power'] >= 0 && $myr['power'] <= 4){
                        $arrSimple[] = $myr;
                    }  
                    if($myr['power'] > 4 && $myr['power'] <= 7){
                        $arrNorm[] = $myr;
                    } 
                    if($myr['power'] > 7){
                        $arrHard[] = $myr;
                    } 
                }while($myr = mysqli_fetch_assoc($res));
                
                $total = intval(((count($arr) - 1) / LIMIT) + 1);
                $totalSmall = intval(((count($arrSmall) - 1) / LIMIT) + 1);
                $totalMed = intval(((count($arrMed) - 1) / LIMIT) + 1);
                $totalBig = intval(((count($arrBig) - 1) / LIMIT) + 1);
                $totalSimple = intval(((count($arrSimple) - 1) / LIMIT) + 1);
                $totalNorm = intval(((count($arrNorm) - 1) / LIMIT) + 1);
                $totalHard = intval(((count($arrHard) - 1) / LIMIT) + 1);
                //формирование шапки и обязательный тегов xml
                $text = '<?xml version="1.0" encoding="UTF-8"?>
                    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
                    <!-- Last update of sitemap '.date("Y-m-d H:i:s+06:00").' -->';
                //Главная страница и домен сайта
                $text.="\r\n<url><loc>".DOMEN."</loc><changefreq>weekly</changefreq><priority>0.5</priority></url>";
                //Второстепенные страницы
                $text.="\r\n<url><loc>".DOMEN."/add.php</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                $text.="\r\n<url><loc>".DOMEN."/ans.php</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                $text.="\r\n<url><loc>".DOMEN."/registr.php</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                $text.="\r\n<url><loc>".DOMEN."/login.php</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                $text.="\r\n<url><loc>".DOMEN."/new_pass.php</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                //Постраничные категории кроссвордов
                for($i = 0; $i < $total; $i++){
                    if($i > 0){
                        $text.="\r\n<url><loc>".DOMEN."/index.php?page=".($i+1)."</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                    }
                }
                //Постраничные категории маленьких кроссвордов
                $text.="\r\n<url><loc>".DOMEN."/index.php?size=small</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                for($i = 0; $i < $totalSmall; $i++){
                    if($i > 0){
                        $text.="\r\n<url><loc>".DOMEN."/index.php?page=".($i+1)."&saze=small</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                    }
                }
                //Постраничные категории кроссвордов средних размеров
                $text.="\r\n<url><loc>".DOMEN."/index.php?size=medium</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                for($i = 0; $i < $totalMed; $i++){
                    if($i > 0){
                        $text.="\r\n<url><loc>".DOMEN."/index.php?page=".($i+1)."&saze=medium</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                    }
                }
                //Постраничные категории кроссвордов больших размеров
                $text.="\r\n<url><loc>".DOMEN."/index.php?size=big</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                for($i = 0; $i < $totalBig; $i++){
                    if($i > 0){
                        $text.="\r\n<url><loc>".DOMEN."/index.php?page=".($i+1)."&saze=big</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                    }
                }
                //Постраничные категории легких кроссвордов
                $text.="\r\n<url><loc>".DOMEN."/index.php?size=simple</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                for($i = 0; $i < $totalSimple; $i++){
                    if($i > 0){
                        $text.="\r\n<url><loc>".DOMEN."/index.php?page=".($i+1)."&saze=simple</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                    }
                }
                //Постраничные категории кроссвордов средней сложности
                $text.="\r\n<url><loc>".DOMEN."/index.php?size=normal</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                for($i = 0; $i < $totalNorm; $i++){
                    if($i > 0){
                        $text.="\r\n<url><loc>".DOMEN."/index.php?page=".($i+1)."&saze=normal</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                    }
                }
                //Постраничные категории сложных кроссвордов
                $text.="\r\n<url><loc>".DOMEN."/index.php?size=hard</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                for($i = 0; $i < $totalHard; $i++){
                    if($i > 0){
                        $text.="\r\n<url><loc>".DOMEN."/index.php?page=".($i+1)."&saze=hard</loc><changefreq>weekly</changefreq><priority>0.3</priority></url>";
                    }
                }
                //Ссылка на каждый кроссворд
                for($i = 0; $i < count($arr); $i++){
                    if($i > 0){
                        $text.="\r\n<url><loc>".DOMEN."/cross.php?cross=".$arr[$i]['id']."</loc><changefreq>weekly</changefreq><priority>0.5</priority></url>";
                    }
                }
                $text.="\r\n</urlset>";
                $text=trim(strtr($text,array('%2F'=>'/','%3A'=>':','%3F'=>'?','%3D'=>'=','%26'=>'&','%27'=>"'",'%22'=>'"','%3E'=>'>','%3C'=>'<','%23'=>'#','&'=>'&amp;')));
                
                $counLink = count(explode('<loc>', $text)) - 1;
                $newDate = TIMES + 60*60*24*7;
                $up = mysqli_query($db, "UPDATE dk_set SET date_site_map='$newDate',count_link_sitemap='$counLink'");
                
                $fp=fopen($engine_root.'/sitemap.xml','w+');if(!fwrite($fp,$text)){return false;}fclose($fp); 
            }   
        }        
    }
?>