<?php

namespace ph\utils;

final class Util {

    private function __construct() { }

    public static function isEmpty($obj) {
        if ($obj === null) {
            return true;
        }
        if (is_string($obj) && trim($obj) === '') {
            return true;
        }
        if (is_array($obj) && count($obj) === 0) {
            return true;
        }
        return empty($obj);
    }
}
