<?php

class Session {
    
    public static function init() {
        @session_start();
    }
    
    public static function get($key) {
        Session::init();
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else
            return null;
    }
    
    public static function add($key, $value) {
        Session::init();
        if(!isset($_SESSION[$key])) {
            $_SESSION[$key] = array();
        }
        if($key == 'panier') {
            $found = false;
            foreach($_SESSION[$key] as &$val) {
                if($val['prod'] == $value['prod']) {
                    $val['qte'] += $value['qte'];
                    $found = true;
                    break;
                }
            }
            if(!$found)
                array_push($_SESSION[$key], $value);
            return $found;
        } else {
            array_push($_SESSION[$key], $value);
        }
    }
    
    public static function remove($key, $value) {
        Session::init();
        if($key == 'panier') {
            foreach($_SESSION[$key] as $index => &$val) {
               if($val['prod'] == $value) {
                   echo $index;
                    array_splice($_SESSION[$key], $index - 1, 1);  
                   break;
               }
            }
        }
    }
    
    public static function set($key, $value) {
        Session::init();
        $_SESSION[$key] = $value;
    }
    
    public static function destroySess($key) {
        Session::init();
        unset($_SESSION[$key]);
    }
    
    public static function destroy() {
        unset($_SESSION);
        @session_destroy();
    }
    
}

?>