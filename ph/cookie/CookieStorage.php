<?php

namespace ph\cookie;

use config\Config;
use ph\utils\TimeUtil;

class CookieStorage {
    private static $COOKIE_PREFIX = 'ph_';

    public static function get($name, $defaultValue = null) {
        return isset($_COOKIE[self::prefixed($name)]) ? $_COOKIE[self::prefixed($name)] : $defaultValue;
    }

    public static function add($name, $value, $expired = null) {
        if ($expired === null) {
            $expired = TimeUtil::getTimeAfter(1)->year();
        }
        setcookie(self::prefixed($name), $value, $expired, Config::getBasePath());
    }

    public static function delete($name) {
        setcookie(self::prefixed($name), 1, TimeUtil::getTime() - 3600, Config::getBasePath());
    }

    public static function contains($name) {
        return isset($_COOKIE[self::prefixed($name)]);
    }

    private static function prefixed($name) {
        return self::$COOKIE_PREFIX . $name;
    }
}
