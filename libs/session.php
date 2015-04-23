<?php

class Session {
    
    public static function init() {
        @session_start();
    }
    
    public static function get($key) {
        return $_SESSION[$key];
    }
    
    public static function set($key, $value) {
        if(!isset($_SESSION[$key])) {
            $_SESSION[$key] = array();
        }
        array_push($_SESSION[$key],$value);
    }
    
    public function destroy() {
        unset($_SESSION);
        @session_destroy();
    }
    
}

?>