<?php

abstract class Status {
    protected $successor;

    abstract public function check(ServerStatus $serverStatus);

    public function succeedWith(Status $status)
    {
        $this->successor = $status;
    }

    public function next(ServerStatus $serverStatus)
    {
        if($this->successor) {
            $this->successor->check($serverStatus);
        }
    }
}

class ApacheStatus extends Status {

    public function check(ServerStatus $serverStatus)
    {
        if(!$serverStatus->apacheRunning) {
            throw new Exception('Apache is off!');
        }

        $this->next($serverStatus);
    }
}

class MysqlStatus extends Status {

    public function check(ServerStatus $serverStatus)
    {
        if(!$serverStatus->mysqlRunning) {
            throw new Exception('Mysql is off!');
        }

        $this->next($serverStatus);
    }
}

class SiteStatus extends Status {
    public function check(ServerStatus $serverStatus)
    {
        if(!$serverStatus->codeQaDone) {
            throw new Exception('QA is not done!');
        }

        $this->next($serverStatus);
    }
}

class ServerStatus {
    public $apacheRunning = true;
    public $mysqlRunning = true;
    public $codeQaDone = false;
}



$siteStatus = new SiteStatus();
$apacheStatus = new ApacheStatus();
$mysqlStatus = new MysqlStatus();

$siteStatus->succeedWith($apacheStatus);
$apacheStatus->succeedWith($mysqlStatus);

$siteStatus->check(new ServerStatus());