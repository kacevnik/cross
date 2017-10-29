<?php

	include("inc/core.php");
	require 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.yandex.ru';                       // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = ADMIN_EMAIL;                        // SMTP username
	$mail->Password = ADMIN_EMAIL_PASS;                   // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;


	if($_GET['m'])    {$hash = $_GET['m'];}
	if($_GET['ban'])  {$ban = $_GET['ban'];}

	//Проверка через регулярные выражения входной переменной
	if (preg_match("/^[a-z0-9]{32,32}$/i",$hash)){$hash = $hash;}else{unset($hash);}

	if(!$hash){
		echo "<h2>Ошибка: Отсутствуют или неправильные входные параметры!</h2>";
		exit();
	}

	function getCommentData($hash){
		global $db;
		$sql = "SELECT name_user,email_user,id_user FROM dk_comments WHERE metka='$hash'";
		$res = mysqli_query($db, $sql);
		if(mysqli_num_rows($res) > 0){
			$myr = mysqli_fetch_assoc($res);
			return $myr;
		}
		return 0;
	}

	function delComment($email, $hash, $ban = 0){
		global $db;
		$ban_data = time() + 2592000;
		$sql   = "INSERT INTO dk_options (name, text_option, date_option) VALUES ('ban_comment_".$email."','$ban_data', '".TIMES."')";
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
		$user      = $dataComment['id_user'];
		$userEmail = $dataComment['email_user'];
		$name_user = $dataComment['name_user'];
		if(!delComment($userEmail, $hash, $ban)){
			echo "<h2>Ошибка: Комментарий не удален</h2>";
		}else{
			if($ban == 1){
				$text_mail  = '<h4>Здравствуйте, '. $name_user .'</h4>';
				$text_mail .= '<p>В связи с нарушением правил использования сервиса обмена сообщениями и комментирования на сайте Samurai-ka.ru, Ваш аккаунт будет заблокирован сроком на 30 дней. В связи с чем вы не сможете пользоваться вышеречисленными сервисами. Остальные функции остаются доступными.</p>';
				$text_mail .= '<p>Данное сообщение сгенерированно автоматически. Отвечать на него не надо!</p>';

				$mail->setFrom(ADMIN_EMAIL, TITLE_SITE);
				$mail->addAddress($userEmail, $userEmail);          // Add a recipient            

				$mail->isHTML(true);                                // Set email format to HTML

				$mail->Subject = 'Сообщение с сайта Samurai-ka.ru';
				$mail->Body    = $text_mail;

				if(!$mail->send()) {
				    //echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {

				}
			}
			echo "<h2>Комментарий удален</h2>";
		}
	}

?>