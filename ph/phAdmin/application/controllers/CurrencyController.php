<?php

namespace ph\phAdmin\application\controllers;

use ph\controller\BaseController;
use ph\phAdmin\application\models\CurrencyModel;
use ph\sessions\flash\FlashMessageStorage as messages;

class CurrencyController extends BaseController {

    public function index() {
        $this->setViewVariable('exchangeRates', CurrencyModel::getInstance()->getExchangeRates());
        $this->render();
    }

    public function save($currencyId) {
        if (!$this->isPostRequest()) exit;

        try {
            $exchangeRate = $this->param('exchangeRate');
            $exchangeRate['currency'] = $currencyId;
            CurrencyModel::getInstance()->saveExchangeRate($exchangeRate);
            messages::add('Currency_Saved', 1, 'success');
            $this->redirectBack();
        } catch (\Exception $e) {
            messages::add('Error', 1, 'error');
            $this->redirectBack();
        }
    }
}
