<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Файлы phpmailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Переменные, которые отправляет пользователь
$rub = $_POST['rub'];
$select = $_POST['select'];
// $result = $_POST['result'];
$email = $_POST['email'];

// Формирование самого письма
$title = "Заголовок письма";
$body = "
<h2>Новое письмо</h2>
<b>Рубли:</b>$rub<br>
<b>Валюта:</b>$select<br>
<b>Почта:</b>$email<br><br>
";

// <b>Результат:</b> $result<br>

// Настройки PHPMailer
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    // $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'testdestroyer@yandex.ru'; // Логин на почте
    $mail->Password   = 'htvbgesdxlgdrcaz';
    // $mail->Password   = 'qaz123QAZ'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('testdestroyer@yandex.ru', 'testdestroyer@yandex.ru'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('destroyer.hramov@yandex.ru');  

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body; 

$mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}