<?php
class Event {
    private static $events = [];

    public static function listen($name, $callback) {
        self::$events[$name][] = $callback;
    }

    public static function trigger($name, $argument = null) {
        foreach (self::$events[$name] as $event => $callback) {
            $argument ? call_user_func_array($callback, $argument) : call_user_func($callback);
        }
    }
}

class User {
    public function login() {
        return true;
    }

    public function logout() {
        return true;
    }
}

Event::listen('login', function(){
    echo 'Event user login fired!';
});

$user = new User();

$user->login();
if($user->login()) {
    Event::trigger('login');
}