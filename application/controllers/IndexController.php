<?php

namespace application\controllers;

use application\models\CatalogModel;
use ph\controller\BaseController;

class IndexController extends BaseController {

    public function index() {
        $this->setViewVariable('mainCatalogs', CatalogModel::getInstance()->getNearestChildren(0));
        $this->render([
            'layout' => 'index'
        ]);
    }
}
