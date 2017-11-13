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


echo 'Another example <br>======================================================<br>';

interface Ability {
    public function perform();
}

class FlyAbility implements Ability {

    public function perform()
    {
        print_r('Fly ability <br>');
    }
}

class WalkAbility implements Ability {

    public function perform()
    {
        print_r('Walk ability <br>');
    }
}

class Duck {
    protected $ability;

    public function addAbility(Ability $ability)
    {
        $this->ability[] = $ability;

        return $this;
    }


    public function showAbilities()
    {
        foreach($this->ability as $ability) {
            $ability->perform();
        }
    }
}


$normalDuck = new Duck();
$normalDuck->addAbility(new FlyAbility())
    ->addAbility(new WalkAbility())
    ->showAbilities();

$flyingDuck = new Duck();
$flyingDuck->addAbility(new FlyAbility())
    ->showAbilities();