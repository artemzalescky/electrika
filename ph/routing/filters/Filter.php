<?php

namespace ph\routing\filters;

abstract class Filter {

    abstract public function filter($route);

    protected function getNotEmptyValue($value, $default) {
        return isset($value) ? $value : $default;
    }

    protected function fillPathParamArr($tokenArr, $from) {
        return $from < count($tokenArr) ? array_slice($tokenArr, $from) : null;
    }

    protected static function getTokenArr($route) {
        $tokenArr = explode('/', $route);
        return array_filter($tokenArr, "self::notEmptyString");
    }

    private static function notEmptyString($var) {
        return $var !== '';
    }
}
