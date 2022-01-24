<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function mailRequest($to, $name, $userId){

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->SMTPDebug = false;
        $mail->Host = 'smtp.mail.us-east-1.awsapps.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply@bfitjle.com';
        $mail->Password = 'jann#2022';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('noreply@bfitjle.com', 'B Fit Service');
        $mail->addAddress($to, $name);
        $mail->addReplyTo('Helpdesk@bfitjle.com', 'B Fit HelpDesk');

        $mail->isHTML(true);
        $mail->Subject = 'Welcome to our community.';
        $mail->Body = mailBody($userId);
        $mail->AltBody = 'User Id '.$userId;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }


}
