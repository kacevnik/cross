<?php 
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    $od_style = '';
    $res = mysqli_query($db, "SELECT id,reting,login_view FROM dk_user WHERE metka='1' ORDER BY reting DESC LIMIT 20");
    if(mysqli_num_rows($res) > 0){
        $myr = mysqli_fetch_assoc($res);
        $show_reiting = 1;
    }
    else{
        $_SESSION['error'] = "<p class='error'>Ошибка запроса!</p>";
        header("Location: login.php");
        exit();  
    }
?>