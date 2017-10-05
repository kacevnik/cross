<?php

	include("inc/core.php");

	if($_GET['m']) {$hash = $_GET['m'];}
	if($_GET['ban'])  {$ban = $_GET['ban'];}
	//Проверка через регулярные выражения входной переменной
	if (preg_match("/^[a-z0-9]{32,32}$/i",$hash)){$hash = $hash;}else{unset($hash);}

	if(!$hash){
		echo "<h2>Ошибка: Отсутствуют или неправильные входные параметры!</h2>";
		exit();
	}

	function getCommentData($hash){
		global $db;
		$sql = "SELECT id_user FROM dk_comments WHERE metka='$hash'";
		$res = mysqli_query($db, $sql);
		if(mysqli_num_rows($res) > 0){
			$myr = mysqli_fetch_assoc($res);
			return $myr;
		}
		return 0;
	}

	function delComment($user, $hash, $ban = 0){
		global $db;
		$ban_data = time() + 2592000;
		$sql   = "INSERT INTO dk_options (name, text_option, date_option) VALUES ('ban_comment_".$user."','$ban_data', '".TIMES."')";
		$sql_2 = "DELETE FROM dk_comments WHERE metka='$hash'";

		if(!mysqli_query($db, $sql_2)){
			return false;
		}
		if($ban == 1){
			if(!mysqli_query($db, $sql)){
				return false;
			}
		}
		return true;
	}

	if(!getCommentData($hash)){
		echo "<h2>Ошибка: Данный комментарий отсутствует</h2>";
		exit();
	}else{
		$dataComment = getCommentData($hash);
		$user = $dataComment['id_user'];
		if(!delComment($user, $hash, $ban)){
			echo "<h2>Ошибка: Комментарий не удален</h2>";
		}else{
			echo "<h2>Комментарий удален</h2>";
		}
	}

?>