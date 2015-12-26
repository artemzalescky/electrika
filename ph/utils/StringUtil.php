<?php

namespace ph\utils;

final class StringUtil {

    private function __construct() { }

    public static function equal($s1, $s2) {
        return strcmp($s1, $s2) === 0;
    }

    public static function equalIgnoreCase($s1, $s2) {
        return strcasecmp($s1, $s2) === 0;
    }

    public static function startWithUpperCase($s) {
        return ucwords($s);
    }

    public static function startWithLowerCase($s) {
        return lcfirst($s);
    }

    public static function camel2Underscore($s) {
        return strtolower(preg_replace('/([A-Z])/', '_$1', $s));
    }

    public static function underscore2Camel($string) {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
        $str[0] = strtolower($str[0]);
        return $str;
    }

    public static function isAbsoluteUrl($url) {
        $externalUrlPattern = '~\w://*~';
        return preg_match($externalUrlPattern, $url) > 0;
    }
}
