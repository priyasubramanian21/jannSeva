<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

mailRequest("Rejinshalb@gmail.com", "123");

function mailRequest($mailId, $userId){

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'mail.tech.angyal.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'hub@tech.angyal.in';
        $mail->Password = 'Apple@123';
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        $mail->setFrom('hub@tech.angyal.in', 'Mail Hub');
        $mail->addAddress($mailId);

        $mail->isHTML(true);
        $mail->Subject = 'Welcome to our community.';
        $mail->Body = mailBo($userId);
        $mail->AltBody = 'User Id '.$userId;
        $mail->send();
        echo "Mail has been sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


}