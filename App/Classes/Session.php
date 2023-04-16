<?php
namespace App\Classes;

use Exception;

class Session {
    static public function set($key, $value) {
        $_SESSION[$key] = $value;
        return $_SESSION[$key];
    }

    static public function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } 

        return null;
    }

    static public function delete($key) {
        $key = Session::get($key);
        if ($key) {
            unset($_SESSION[$key]);
        }
    }

    static public function destory() {
        unset($_SESSION);
        session_destroy();
    }

    static public function user() {
        $user  = Session::get("user");
        return $user;
    }
    
}