<?php

namespace ph\utils;

final class SecurityUtil {

    private function __construct() { }

    public static function encrypt($password) {
        return md5(crypt($password, 'dcf5cd7a48820cd583fa98474722f939'));
    }
}
