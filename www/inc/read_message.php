<?php

	$cross = 10;

    include("core.php");
    include("cross_constructor.php");


	if($_POST['id']){$id     =  (int)trim($_POST['id']);}
	if($_POST['hash']){$hash   =  htmlspecialchars(trim($_POST['hash']));}


	function upDateReading($hash, $id){
		global $db;
		$time = time();
		$sql = "UPDATE dk_message SET date_read='$time' WHERE hash='$hash' AND id_to='$id'";
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

	if(upDateReading($hash, $id)){
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