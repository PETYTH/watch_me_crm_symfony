<?php
namespace App\Controller;
use  App\Services\EmailSender;


class MailPerso extends EmailSender{

    public function sendMailRegister($email, $subject, $firstname, $name, $emailContent) {
        $content = $this->contentAssembly('email.app.content', [
            'firstname' => $firstname,
            'name' => $name,
            'email' => $email,
            'plainPassword' => $emailContent
        ]);
        $this->sendMail($content, $email, $subject);
    }

    public function sendMailEdit($email, $subject, $firstname, $name, $emailContent) {
        $content = $this->contentAssembly('email.app.email-modified', [
            'firstname' => $firstname,
            'name' => $name,
            'email' => $email,
            'plainPassword' => $emailContent
        ]);
        $this->sendMail($content, $email, $subject);
    }


    public function sendMailResetPassword($email, $subject, $message, $name, $firstname){
        $content=$this->contentAssembly('email.app.email-registerForgot',[
            'firstname' => $firstname,
            'name' => $name,
            'message'=>$message,
        ]);
        $mail= new EmailSender();
        $mail->sendMail($content, $email, $subject);
    }

    public  function sendMessage($email, $subject, $message, $name, $firstname){
        $content=$this->contentAssembly('email.app.message-envoye',array(
            'message'=>$message,
            'name'=>$name,
            'firstname'=>$firstname
        ));
        $mail= new EmailSender();
        $mail->sendMail($content, $email, $subject);
    }
    public  function ConfirmedResetPassword($email, $subject, $message, $name, $firstname){
        $content=$this->contentAssembly('email.app.email-resetPassword',array(
            'message'=>$message,
            'name'=>$name,
            'firstname'=>$firstname
        ));
        $mail= new EmailSender();
        $mail->sendMail($content, $email, $subject);
    }

    public  function ConfirmedDelete($email, $subject, $message, $name, $firstname){
        $content=$this->contentAssembly('email.app.email-delete',array(
            'message'=>$message,
            'name'=>$name,
            'firstname'=>$firstname
        ));
        $mail= new EmailSender();
        $mail->sendMail($content, $email, $subject);
    }

}
