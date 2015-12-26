<?php

namespace ph\utils;

final class DebugUtil {

    private function __construct() { }

    public static function varDump($var) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}
