<?php

namespace application\controllers;

use application\models\CatalogModel;
use ph\controller\BaseController;

class IndexController extends BaseController {

    public function index(){
        $catalogs = CatalogModel::getInstance()->getNearestChildren(0);
        $this->setViewVariable('catalogs', $catalogs);
        $this->render([
            'layout' => 'index'
        ]);
    }
}
