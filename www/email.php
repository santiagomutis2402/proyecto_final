<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'f75afa7938cf97';
    $mail->Password = '4ef29f374d2b76';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    $mail->setFrom('freemovie@gmail.com', 'Gerente');
    $mail->addAddress('andrezperez2402@gmail.com');

    // $mail->addAttachment('docs/dashboard.png', 'Dashboard.png');

    $mail->isHTML(true);
    $mail->Subject = 'Codigo de verificacion';
    $mail->Body = 'Hola, <br/>Su codigo de verificacion es: 2402 <b>Gmail</b>.';
    $mail->send();

    echo 'Correo enviado';
} catch (Exception $e) {
    echo 'Mensaje ' . $mail->ErrorInfo;
}