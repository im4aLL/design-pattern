<?php
class Event {
    private static $events = [];

    public static function listen($name, $callback) {
        self::$events[$name][] = $callback;
    }

    public static function trigger($name, $argument = null) {
        foreach (self::$events[$name] as $event => $callback) {
            if($argument && is_array($argument)) {
                call_user_func_array($callback, $argument);
            }
            elseif ($argument && !is_array($argument)) {
                call_user_func($callback, $argument);
            }
            else {
                call_user_func($callback);
            }
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

    public function updated() {
        return true;
    }
}

// Usage
// ==================================

Event::listen('login', function(){
    echo 'Event user login fired! <br>';
});

$user = new User();

if($user->login()) {
    Event::trigger('login');
}

// Usage with param
// ==================================

Event::listen('logout', function($param){
    echo 'Event '. $param .' logout fired! <br>';
});

if($user->logout()) {
    Event::trigger('logout', 'user');
}


// Usage with param as array
// ==================================

Event::listen('updated', function($param1, $param2){
    echo 'Event ('. $param1 .', '. $param2 .') updated fired! <br>';
});

if($user->updated()) {
    Event::trigger('updated', ['param1', 'param2']);
}