<?php

    include("core.php");
    include("cross_constructor.php");

	if($_POST['user']){$user   =  (int)trim($_POST['user']);}
	if($_POST['cross']){$cross =  (int)trim($_POST['cross']);}
	if($_POST['text']){$text   =  htmlspecialchars(trim($_POST['text']));}
	if($_POST['email']){$email =  htmlspecialchars(trim($_POST['email']));}

	$data = array();

	function getInfoUserComment($id_user){
		global $db;
		$sql = "SELECT text_option FROM dk_options WHERE name='ban_comment_".$id_user."'";
		$res = mysqli_query($db, $sql);
		if(mysqli_num_rows($res) > 0){
			$myr = mysqli_fetch_array($res);
			return $myr['text_option'];
		}
		return 0;
	}

	function addNewComment($id_user=0, $cross, $text, $email, $name, $type=0){
		global $db;
		$sql = "INSERT INTO dk_comments (date_add, id_user, id_cross, email_user, name_user, text_comment, type) VALUES ('".TIMES."','$id_user','$cross', '$email', '$name', '$text', '$type')";
		if(mysqli_query($db, $sql)){
			return true;
		}
		return false;
	}

	if(!$text){
		$data['error']   = 1;
		$data['message'] = '<div class="add_comment_error">Укажите текст комментария</div>';
		$data = json_encode($data);
		echo $data;
		exit();
	}

	if($_SESSION['admin']){
		$id_user = getIdFromSes($_SESSION['admin']);
		if($user != $id_user){
			$data['error']   = 1;
			$data['message'] = '<div class="add_comment_error">Ошибка запроса данных</div>';
			$data = json_encode($data);
			echo $data;
			exit();
		}
		if(getInfoUserComment($id_user) < time()) {
			if(addNewComment($id_user, $cross, $text, $email, $name, 1)){
				$data['error']   = 2;
				$data['message'] = 'Ваш комментарий добавлен';
			}
		}else{
			$data['error']   = 1;
			$data['message'] = '<div class="add_comment_error">За нарушение правил<br>Вам запрещено пользоваться<br>комментариями до '. getMainDate(getInfoUserComment($id_user)) .'</div>';
		}

	}else{
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == false){
			$data['error']   = 1;
			$data['message'] = '<div class="add_comment_error">Неправильный E-mail</div>';
			$data = json_encode($data);
			echo $data;
			exit();
		}
	}

			$data = json_encode($data);
			echo $data;

?>