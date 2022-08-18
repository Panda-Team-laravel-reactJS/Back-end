<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail
{
  public const OTP_RECEIVING = "MaySpa - Send you an OTP";
  public const CREATE_ACCOUNT_SUCCESSFULLY = "MaySpa - Welcome to MAySpa";

  public static function send($mailTo, $subject, $content)
  {
    $mail = new PHPMailer(true);
    try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = env("MAIL_HOST");                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = env("MAIL_USERNAME");           //SMTP username
      $mail->Password   = env("MAIL_PASSWORD");                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom(env("MAIL_USERNAME"), env("MAIL_FROM_NAME"));
      $mail->addAddress($mailTo);     //Add a recipient

       //Optional name

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $content;

      $mail->send();
      // echo 'Message has been sent';
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
  public static function sendOTP($mailTo, $name, $otp) {
    Mail::send($mailTo, Mail::OTP_RECEIVING, view("mails.sending-otp", compact("name", "otp") ));
  }
}
