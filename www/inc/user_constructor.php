<?php 
    if(ENTER != 1){echo "УПС, ОБЛОМ"; exit();}
    
    if (isset($_GET['id']))       {$id = $_GET['id'];            $id = (int)abs($id);}

    /**
    * Функция получения данных списка сообщений в личном кабинете
    */
 
    function getListMessage($id){
        global $db;
        $result = array();
        $result['count'] = 0;
        $sql = "SELECT m.hash, m.name, m.message, m.id_autor, m.date_send, m.date_read, u.login_view FROM dk_message m INNER JOIN dk_user u ON u.id='$id' WHERE m.id_to='$id' ORDER BY m.id DESC";
        $res = mysqli_query($db, $sql);
        if(mysqli_num_rows($res) > 0){
            $myr = mysqli_fetch_assoc($res);
            do{
                $result[] = $myr;
                if($myr['date_read'] == 0){
                    $result['count']++; 
                }
            }
            while($myr = mysqli_fetch_assoc($res));
        }else{
            return false;
        }
        return $result;
    }
    
    $res = mysqli_query($db, "SELECT id,login_view,email,time_add,reting,pass,kod FROM dk_user WHERE id='$id' AND metka='1' LIMIT 1");
    if(mysqli_num_rows($res) > 0){
        $myr = mysqli_fetch_assoc($res);
        $proverka = $myr['pass'].$myr['kod'];
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
        $resCountSol = mysqli_query($db, "SELECT SUM(sol_time) AS countSecSol FROM solution WHERE id_user='$id' AND type='1'");
        $countSecSol = mysqli_fetch_assoc($resCountSol);
        $countSecSol = $countSecSol['countSecSol'];

        $list_message = getListMessage($id);

    }
    else{
        $_SESSION['error'] = "<p class='error'>Ошибка запроса!</p>";
        header("Location: login.php");
        exit();  
    }
?>