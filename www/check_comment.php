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
	
	//Проверка через регулярные выражения входной переменной
	if (preg_match("/^[a-z0-9]{32,32}$/i",$hash)){$hash = $hash;}else{unset($hash);}

	if(!$hash){
		$_SESSION['error'] = "<div class='error'>Ошибка: Отсутствуют или неправильные входные параметры!</div>";
        header("Location: index.php");
		exit();
	}

	function getCommentData($hash){
		global $db;
		$sql = "SELECT name_user,email_user,id_user,id_cross,date_add,text_comment FROM dk_comments WHERE metka='$hash'";
		$res = mysqli_query($db, $sql);
		if(mysqli_num_rows($res) > 0){
			$myr = mysqli_fetch_assoc($res);
			return $myr;
		}
		return 0;
	}

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

	function upComment($hash){
		global $db;
		$sql = "UPDATE dk_comments SET type = '1' WHERE metka = '$hash'";
		$res = mysqli_query($db, $sql);
		return true;
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

	if(!getCommentData($hash)){
		$_SESSION['error'] = "<div class='error'>Ошибка: Данный комментарий отсутствует</div>";
        header("Location: index.php");
		exit();
	}else{
		$dataComment = getCommentData($hash);
		$user        = $dataComment['id_user'];
		$userEmail   = $dataComment['email_user'];
		$name_user   = $dataComment['name_user'];
		$id_cross    = $dataComment['id_cross'];
		$date_add    = $dataComment['date_add'];
		$text        = $dataComment['text_comment'];
		if(getInfoUserComment($userEmail) > time()){
			$_SESSION['error'] = '<div class="error">За нарушение правил<br>Вам запрещено пользоваться<br>комментариями до '. getMainDate(getInfoUserComment($userEmail)) .'</div>';
			header("Location: index.php");
			exit();
		}else{
			$name_cross     = getCrossName($cross);
			$name_cross_res = $name_cross['name'];
			if(upComment($hash)){
				$text_mail .= '<p>Комментарий пользователя: '.$name_user.' (Гость)<br>';
				$text_mail .= 'Комментарий к кроссворду: <a href="http://samurai-ka.ru/cross.php?cross'.$id_cross.'" target="_blank">'.$name_cross_res.'</a><br>';
				$text_mail .= 'E-mail пользователя: '.$userEmail.'<br>';
				$text_mail .= 'Дата добавления: '.getMainDate($date_add).'<br>';
				$text_mail .= 'Комментарий:<br><span style="background: #ebebeb; padding: 10px; margin: 10px 0; display: inline-block; border-radius: 5px">'.$text.'</span></p>';
				$text_mail .= '<p><a style="color: #ff5759;" href="http://samurai-ka.ru/del_comment.php?m='.$metka.'">Удалить Комментарий</a><br>';
				$text_mail .= '<a style="color: #ff5759;" href="http://samurai-ka.ru/del_comment.php?m='.$metka.'&ban=1">Удалить Комментарий с баном</a></p>';

				$mail->setFrom(ADMIN_EMAIL, TITLE_SITE);
				$mail->addAddress(ADMIN_EMAIL, ADMIN_EMAIL);          // Add a recipient            

				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = 'Новый комментарий на сайте (Гость)';
				$mail->Body    = $text_mail;

				if(!$mail->send()) {
					$_SESSION['error'] = '<div class="error">Возникла ошибка. Комментарий не добавлен!</div>';
					header("Location: index.php");
					exit();
				} else {
					$_SESSION['error'] = '<div class="error_plus">Спасибо. Комментарий добавлен!</div>';
					header("Location: cross.php?cross".$id_cross);
					exit();
				}
			}
		}
	}

?>