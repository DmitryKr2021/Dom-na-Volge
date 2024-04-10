<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	//use PHPMailer\PHPMailer;
	//use PHPMailer\Exception;

	require '../phpmailer/Exception.php';
	require '../phpmailer/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', '../phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('Сайт "Отдых-на-Волге"');
	//Кому отправить
	$mail->addAddress('krdvmail@mail.ru');
	//Тема письма
	$mail->Subject = 'Отзыв с сайта "Отдых-на-Волге"';

	//Тело письма
	$body = '<h1>Отзыв с сайта Отдых-на-Волге</h1>';
	
	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
	}
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}
	if(trim(!empty($_POST['message']))){
		$body.='<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';
	}
	if(trim(!empty($_POST['range']))){
		$body.='<p><strong>Оценка:</strong> '.$_POST['range'].'</p>';
	}
	
	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Ваш отзыв отправлен!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>