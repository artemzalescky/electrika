<?php

namespace ph\sessions;

/*
*   need \config\Config::USE_SESSION to be 'true'
*/

class SessionStorage {

    public static function initialize() {
        if (!session_id()) {
            session_start();
        }
    }

    public static function get($name) {
        return $_SESSION[$name];
    }

    public static function add($name, $value, $overwrite = true) {
        if (!$overwrite && self::contains($name)) return;
        $_SESSION[$name] = $value;
    }

    public static function delete($name) {
        unset($_SESSION[$name]);
    }

    public static function contains($name) {
        return isset($_SESSION[$name]);
    }

    public static function getAll() {
        return $_SESSION;
    }

    public static function clear() {
        session_unset();
    }
}
