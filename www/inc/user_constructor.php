<?php 
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    if (isset($_GET['id']))       {$id = $_GET['id'];            $id = (int)abs($id);}
    
    $res = mysqli_query($db, "SELECT id,login_view,email,time_add,reting FROM dk_user WHERE id='$id' AND metka='1' LIMIT 1");
    if(mysqli_num_rows($res) > 0){
        $myr = mysqli_fetch_assoc($res);
        $login = $myr['login_view'];
        $email = $myr['email'];
        $reting = $myr['reting'];
        $time_add = getMainDate($myr['time_add']);
        $resReiting = mysqli_query($db, "SELECT id FROM dk_user WHERE reting>'$reting' AND metka='1'");
        $mesto = mysqli_num_rows($resReiting) + 1;
        $resCrossUser = mysqli_query($db, "SELECT id FROM dk_cross WHERE user_add_id='$id'");
        $add_user = mysqli_num_rows($resCrossUser);
        $resCrossSol = mysqli_query($db, "SELECT id FROM solution WHERE id_user='$id' AND type='1'");
        $solution = mysqli_num_rows($resCrossSol);
    }
    else{
        $_SESSION['error'] = "<p class='error'>Ошибка запроса!</p>";
        header("Location: login.php");
        exit();  
    }
?>