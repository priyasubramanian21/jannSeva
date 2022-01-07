<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function sendOTP($email, $otp)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = false;
    $mail->Host = 'smtp.mail.us-east-1.awsapps.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@bfitjle.com';
    $mail->Password = 'jann#2022';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('noreply@bfitjle.com', 'B Fit Service');
    $mail->addAddress($email);
    $mail->addReplyTo('Helpdesk@bfitjle.com', 'B Fit HelpDesk');

    $message_body = "One Time Password for Password Reset is:<br/><br/>" . $otp;


    $mail->Subject = "OTP";
    $mail->MsgHTML($message_body);
    $mail->IsHTML(true);
    $result = $mail->Send();

    return $result;
}
