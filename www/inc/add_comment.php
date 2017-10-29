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
	$metka = md5(microtime());

	if($_POST['user']){$user   =  (int)trim($_POST['user']);}
	if($_POST['cross']){$cross =  (int)trim($_POST['cross']);}
	if($_POST['text']){$text   =  nl2br(htmlspecialchars(trim($_POST['text'])));}
	if($_POST['email']){$email =  htmlspecialchars(trim($_POST['email']));}
	if($_POST['name']){$name   =  htmlspecialchars(trim($_POST['name']));}
	if($_POST['hash']){$hash   =  htmlspecialchars(trim($_POST['hash']));}

	$data = array();

	function getInfoUserComment($email){
		global $db;
		$sql = "SELECT text_option FROM dk_options WHERE name='ban_comment_".$email."'";
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

	function addNewComment($id_user=0, $cross, $text, $email, $name, $type=0, $metka){
		global $db;
		$sql = "INSERT INTO dk_comments (date_add, id_user, id_cross, email_user, name_user, text_comment, type, metka) VALUES ('".TIMES."','$id_user','$cross', '$email', '$name', '$text', '$type', '$metka')";
		if(mysqli_query($db, $sql)){
			return true;
		}
		return false;
	}

	function checkCrossComment($cross, $hash){
		global $db;
		$sql = "SELECT id FROM dk_cross WHERE id='$cross' AND img='$hash'";
		$res = mysqli_query($db, $sql);
		if(mysqli_num_rows($res) > 0){
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

	if(!checkCrossComment($cross, $hash)){
		$data['error']   = 1;
		$data['message'] = '<div class="add_comment_error">Ошибка данных кроссворда</div>';
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
		$user_data      = getdataUserForComment($id_user);
		$name           = $user_data['login_view'];
		$email          = $user_data['email'];
		if(getInfoUserComment($email) < time()) {
			$name_cross     = getCrossName($cross);
			$name_cross_res = $name_cross['name'];
			$text_mail      = '';
			if(addNewComment($id_user, $cross, $text, $email, $name, 1, $metka)){
				$text_mail .= '<p>Комментарий пользователя: <a href="http://samurai-ka.ru/user.php?id='.$id_user.'" target="_blank">'.$name.'</a><br>';
				$text_mail .= 'Комментарий к кроссворду: <a href="http://samurai-ka.ru/cross.php?cross='.$cross.'" target="_blank">'.$name_cross_res.'</a><br>';
				$text_mail .= 'E-mail пользователя: '.$email.'<br>';
				$text_mail .= 'Дата добавления: '.getMainDate(time()).'<br>';
				$text_mail .= 'Комментарий:<br><span style="background: #ebebeb; padding: 10px; margin: 10px 0; display: inline-block; border-radius: 5px">'.$text.'</span></p>';
				$text_mail .= '<p><a style="color: #ff5759;" href="http://samurai-ka.ru/del_comment.php?m='.$metka.'">Удалить Комментарий</a><br>';
				$text_mail .= '<a style="color: #ff5759;" href="http://samurai-ka.ru/del_comment.php?m='.$metka.'&ban=1">Удалить Комментарий с баном</a></p>';

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
			$data['message'] = '<div class="add_comment_error">За нарушение правил<br>Вам запрещено пользоваться<br>комментариями до '. getMainDate(getInfoUserComment($email)) .'</div>';
		}

	}else{
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == false){
			$data['error']   = 1;
			$data['message'] = '<div class="add_comment_error">Неправильный E-mail</div>';
			$data = json_encode($data);
			echo $data;
			exit();
		}
		if(!$name){
			$data['error']   = 1;
			$data['message'] = '<div class="add_comment_error">Укажите Ваше имя</div>';
			$data = json_encode($data);
			echo $data;
			exit();
		}
		if(getInfoUserComment($email) < time()) {
			if(addNewComment(0, $cross, $text, $email, $name, 0, $metka)){
				$text_mail .= '<p>Добрый день.<br>';
				$text_mail .= 'Вы оставили комментарий на сайте японских кроссвордов <a href="http://samurai-ka.ru" target="_blank">Samurai-ka.ru</a><br>';
				$text_mail .= 'Для того, что-бы он стал отображаться, следует подтвердить, что Вы не робот, перейдя по ссылке ниже.</p>';
				$text_mail .= '<p><a href="http://samurai-ka.ru/check_comment.php?m='.$metka.'" target="_blank">Подтвердить комментарий</a></p>';
				$text_mail .= '<p>Данное сообщение сгенерированно автоматически. Отвечать на него не нужно. Спасибо.</p>';

				$mail->setFrom('admin@samurai-ka.ru', 'Samurai-ka.ru');
				$mail->addAddress($email, $email);          // Add a recipient            

				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = 'Новый комментарий на сайте';
				$mail->Body    = $text_mail;

				if(!$mail->send()) {
				    //echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
				    $data['error']   = 2;
					$data['message'] = 'Ваш комментарий добавлен.<br>Перейдите на указанную почту:<br><i style="font-size: 16px;
    color: #188400;">'.$email.'</i><br>И подтвердите комментарий';
				}
			}
		}else{
			$data['error']   = 1;
			$data['message'] = '<div class="add_comment_error">За нарушение правил<br>Вам запрещено пользоваться<br>комментариями до '. getMainDate(getInfoUserComment($email)) .'</div>';
		}
	}

			$data = json_encode($data);
			echo $data;

?>