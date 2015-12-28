<?php

namespace application\controllers;

use application\models\CatalogModel;
use ph\controller\BaseController;

class IndexController extends BaseController {

    public function index() {
        $mainCatalogs = CatalogModel::getInstance()->getNearestChildren(0);
        $this->setViewVariable('nearestChildren', $mainCatalogs);
        $this->render([
            'layout' => 'index'
        ]);
    }
}
