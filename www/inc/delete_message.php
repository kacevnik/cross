<?php

    $cross = 10;

    include("core.php");
    include("cross_constructor.php");


    if($_POST['id']){$id     =  (int)trim($_POST['id']);}
    if($_POST['hash']){$hash   =  htmlspecialchars(trim($_POST['hash']));}


    function deleteMessage($hash, $id){
        global $db;
        $sql = "DELETE FROM dk_message WHERE hash='$hash' AND id_to='$id'";
        if(mysqli_query($db, $sql)){
            return true;
        }else{
            return false;
        }
    }

    $data = array();

    if($_SESSION['admin']){
        $id_user = getIdFromSes($_SESSION['admin']);
        if($id != $id_user){
            $data['error'] = 1;
            $data = json_encode($data);
            echo $data;
            exit();
        }
    }

    if(deleteMessage($hash, $id)){
        $data['error'] = 2;
    }else{
        $data['error'] = 1;
        $data = json_encode($data);
        echo $data;
        exit();
    }

    $data = json_encode($data);
    echo $data;

?>