<?php 
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    $od_style = '';
    $res = mysqli_query($db, "SELECT id,reting,login_view FROM dk_user WHERE metka='1' ORDER BY reting DESC LIMIT 20");
    if(mysqli_num_rows($res) > 0){
        $myr = mysqli_fetch_assoc($res);
        $show_reiting = 1;
        $name_option = 'list_best_user_'.date("d_m_Y");
        $res_option = mysqli_query($db, "SELECT text_option FROM dk_options WHERE name='$name_option' LIMIT 1");
        if(mysqli_num_rows($res_option) > 0){
            $myr_option = mysqli_fetch_assoc($res_option);
            $option_list = unserialize($myr_option['text_option']);
        }
    }
    else{
        $_SESSION['error'] = "<p class='error'>Ошибка запроса!</p>";
        header("Location: login.php");
        exit();  
    }
?>