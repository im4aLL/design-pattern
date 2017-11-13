<?php

interface MailServiceInterface {
    public function sendEmail();
}

class SMTPService implements MailServiceInterface {

    public function sendEmail()
    {
        echo 'Using SMTP mail service! <br>';
    }
}

class OtherService implements MailServiceInterface {

    public function sendEmail()
    {
        echo 'Using Other mail service! <br>';
    }
}


class MailService {

    protected $mailService;

    public function __construct(MailServiceInterface $mailService)
    {
        $this->mailService = $mailService;
    }

    public function to($email) {
        echo 'Sending email to - ' . $email . '<br>';

        return $this;
    }

    public function message($message) {
        echo 'Message body - ' . $message . '<br>';

        return $this;
    }

    public function send()
    {
        $this->mailService->sendEmail();
    }

}

$mailer = new MailService(new SMTPService());
$mailer->to('me@habibhadi.com')->message('Hi this is mail text')->send();