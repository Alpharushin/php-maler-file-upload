<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Expection;
require '../vendor/autoload.php';

require 'files.php';

 //echo "<pre>";
 //print_r($filesToAttach);
//echo "</pre>";

$mail = new PHPMailer();

$mail ->addAddress('ayazfaritovich@rambler.ru','to Ayaz');

$mail ->setFrom('i6237@nwytg.net','Spammer');

function adopt($text) {
	return '=?UTF-8?B?'.base64_encode($text).'?=';
}

$mail ->Subject = adopt("Тестовый спам!");

$mail ->isHTML(true);

$message = "<h3> Сообщение с сайта.</h3>" .
           "<p>" . $_POST['name'] . "</p>" .
           "<p><strong>Сообщение:</strong></p>" .
           "<p>" . $_POST['message'] . "</p>";

$mail ->Body = $message ;

foreach ($filesToAttach as $key => $value) {
  $mail ->addAttachment($value , adopt($key));
}


if ($mail->send()) {
  echo "Сообщение отправлено";
} else {
  echo "Сообщение НЕ отправлено";
}



?>