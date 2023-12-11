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


    public function sendMailRegisterForgotPassword($email, $subject){
        $content=$this->contentAssembly('email.app.email-registerForgot');
        $mail= new EmailSender();
        $mail->sendMail($content, $email, $subject);
    }

    public  function sendContact($email, $content, $subject){
        $envoi=$this->contentAssembly('email.app.message-envoye');
        $content=$this->contentAssembly('email.app.send-contact',array(
            'subject'=>$subject,
            'content'=>$content,
            'email'=>$email,
        ));
        $mail= new EmailSender();
        $mail->sendMail($envoi, $email, 'Message envoyé !');
        $mail->sendMail($content, $email, 'Vous avez un message en attente de ' . $email . ' ', true);
    }


}
