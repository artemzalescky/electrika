<?php

namespace ph\phAdmin\application\models;

use ph\constants\Currency as CurrencyValue;
use ph\exception\PhException;
use ph\phAdmin\application\models\dao\ExchangeRatesDAO;

class CurrencyModel {
    private static $instance;
    private $exchangeRatesDAO;
    private $exchangeRates;

    private function __construct() {
        $this->exchangeRatesDAO = new ExchangeRatesDAO();
        $this->exchangeRates = $this->exchangeRatesDAO->get();
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function convert($value, $from = null, $to = null) {
        if (empty($to)) {
            $to = $this->getDefault();
        }
        if (empty($from)) {
            $from = $this->getSecondDefault();
        }
        $value = floatval($value);
        $fromRate = $this->getExchangeRateValue($from);
        $toRate = $this->getExchangeRateValue($to);
        return $value * $fromRate / $toRate;
    }

    public function convertWithRounding($value, $rounding = -2, $from = null, $to = null) {
        $converted = $this->convert($value, $from, $to);
        return round($converted, $rounding);
    }

    public function getExchangeRates() {
        $res = [];
        foreach ($this->exchangeRates as $exchangeRate) {
            if ($exchangeRate['currency'] != $this->getDefault()) {
                $res[] = $exchangeRate;
            }
        }
        return $res;
    }

    public function saveExchangeRate($exchangeRate) {
        $this->validateExchangeRate($exchangeRate);
        return $this->exchangeRatesDAO->save($exchangeRate);
    }

    public function getDefault() {
        return CurrencyValue::BYR;
    }

    private function getSecondDefault() {
        return CurrencyValue::USD;
    }

    private function getExchangeRateValue($currencyId) {
        if ($currencyId == $this->getDefault()) {
            return 1;
        }
        foreach ($this->exchangeRates as $exchangeRate) {
            if (intval($exchangeRate['currency']) == $currencyId) {
                return $exchangeRate['value'];
            }
        }
        return 1;
    }

    private function validateExchangeRate($exchangeRate) {
        if ($exchangeRate['value'] <= 0) {
            throw new PhException();
        }
    }
}
