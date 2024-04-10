<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/Exception.php';
	require 'phpmailer/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('Сайт "Отдых-на-Волге"');
	//Кому отправить
	$mail->addAddress('krdvmail@mail.ru');
	//Тема письма
	$mail->Subject = 'Заявка с сайта "Отдых-на-Волге"';

	//Тело письма
	$body = '<h1>Заявка с сайта "Отдых-на-Волге"</h1>';
	
	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
	}
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}
	if(trim(!empty($_POST['phone']))){
		$body.='<p><strong>Тел:</strong> '.$_POST['phone'].'</p>';
	}
	if(trim(!empty($_POST['date']))){
		$body.='<p><strong>Дата начала отдыха:</strong> '.$_POST['date'].'</p>';
	}
	if(trim(!empty($_POST['days']))){
		$body.='<p><strong>Количество дней:</strong> '.$_POST['days'].'</p>';
	}
	if(trim(!empty($_POST['persons']))){
		$body.='<p><strong>Количество отдыхающих:</strong> '.$_POST['persons'].'</p>';
	}
	if(trim(!empty($_POST['message']))){
		$body.='<p><strong>Примечание:</strong> '.$_POST['message'].'</p>';
	}
	
	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Ваша заявка получена! В ближайшее время мы с Вами свяжемся';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>