<?php

interface NotificationInterface {
    public function send();
}

class Notification implements NotificationInterface {
    public function send()
    {
        return 'Default notification service!';
    }
}

class SMS {
    public function differentSendMethod()
    {
        return 'SMS notification service';
    }
}

class SMSAdapter extends SMS implements NotificationInterface {
    protected $notificationInterface;

    public function __construct(NotificationInterface $notificationInterface)
    {
        $this->notificationInterface = $notificationInterface;
    }

    public function send()
    {
        return $this->differentSendMethod();
    }
}


$notification = new Notification();
$notification = new SMSAdapter(new Notification());
echo $notification->send();


echo '<br>=========================================================================================<br>';


interface FileUploadInterface {
    public function setFile($file);

    public function upload();
}

class FileUploadManager {
    protected $fileUploadInterface;

    public function setDriver(FileUploadInterface $fileUploadInterface)
    {
        $this->fileUploadInterface = $fileUploadInterface;

        return $this->fileUploadInterface;
    }
}

class AmazonFileUploader {
    public function anotherUploadMethod()
    {
        echo 'Uploading from amazon file uploader!';
    }
}

class AmazonFileUploadAdapter extends AmazonFileUploader implements FileUploadInterface {

    public function setFile($file)
    {
        echo 'Initialize file '. $file . '<br>';

        return $this;
    }

    public function upload()
    {
        return $this->anotherUploadMethod();
    }
}

$fileUploder = new FileUploadManager();
$fileUploder->setDriver(new AmazonFileUploadAdapter())->setFile('a.jpg')->upload();