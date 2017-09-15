<?php

    include("core.php");
    include("cross_constructor.php");
    require '../PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.yandex.ru';                       // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'admin@samurai-ka.ru';              // SMTP username
	$mail->Password = 'A9564665a';                        // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;

	$adminEmail = 'admin@samurai-ka.ru';

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

	function getCrossName($cross){
		global $db;
		$sql = "SELECT name FROM dk_cross WHERE id='$cross'";
		$res = mysqli_query($db, $sql);
		if(mysqli_num_rows($res) > 0){
			$myr = mysqli_fetch_assoc($res);
			return $myr;
		}
		return 0;
	}	

	function getdataUserForComment($id_user){
		global $db;
		$sql = "SELECT login_view, email FROM dk_user WHERE id='$id_user'";
		$res = mysqli_query($db, $sql);
		if(mysqli_num_rows($res) > 0){
			$myr = mysqli_fetch_assoc($res);
			return $myr;
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
			$user_data      = getdataUserForComment($id_user);
			$name_cross     = getCrossName($cross);
			$name_cross_res = $name_cross['name'];
			$name           = $user_data['login_view'];
			$email          = $user_data['email'];
			$text_mail      = '';
			if(addNewComment($id_user, $cross, $text, $email, $name, 1)){
				$text_mail .= '<p>Комментарий пользователя: <a href="http://samurai-ka.ru/user.php?id='.$id_user.'" target="_blank">'.$name.'</a><br>';
				$text_mail .= '<p>Комментарий к кроссворду: <a href="http://samurai-ka.ru/cross.php?cross'.$cross.'" target="_blank">'.$name_cross_res.'</a><br>';
				$text_mail .= 'E-mail пользователя: '.$email.'<br>';
				$text_mail .= 'Дата добавления: '.getMainDate(time()).'<br>';
				$text_mail .= 'Комментарий:<br>'.$text.'</p>';
				//$text .= '<p>Комментарий пользователя: <a>'..'</a><br></p>';

				$mail->setFrom('admin@samurai-ka.ru', 'Samurai-ka.ru');
				$mail->addAddress($adminEmail, $adminEmail);          // Add a recipient            

				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = 'Новый комментарий на сайте';
				$mail->Body    = $text_mail;

				if(!$mail->send()) {
				    //echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
				    $data['error']   = 2;
					$data['message'] = 'Ваш комментарий добавлен';
				}
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