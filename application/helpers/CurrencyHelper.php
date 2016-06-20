<?php

namespace application\helpers;

class CurrencyHelper {
    public static function price_byr($price) {
        return number_format($price, 2, '.', '');
    }

    public static function price_byr_before_denomination($price) {
        return number_format($price * 10000, 0, '.', ' ');
    }
}
