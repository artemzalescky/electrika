<?php

namespace ph\phAdmin\application\models\dao;

use ph\config\Settings;
use ph\db\DbDataAccessObject;

class ExchangeRatesDAO extends DbDataAccessObject {

    public function __construct() {
        parent::__construct(Settings::SYSTEM_TABLE_PREFIX . 'exchange_rates');
    }

    public function get() {
        return parent::get();
    }

    public function save($exchangeRate) {
        return parent::update(
            ['value' => $exchangeRate['value']],
            ['currency' => $exchangeRate['currency']]
        );
    }
}
