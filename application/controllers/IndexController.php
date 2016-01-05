<?php

namespace application\controllers;

use application\models\CatalogModel;
use application\models\SpecialOfferModel;
use ph\controller\BaseController;

class IndexController extends BaseController {

    public function index() {
        $this->setViewVariable('currentCatalog', CatalogModel::getInstance()->getRootCatalog());
        $this->setViewVariable('nearestChildren', CatalogModel::getInstance()->getNearestChildren(0));
        $this->setViewVariable('specialOfferProducts', $this->splitByRows(SpecialOfferModel::getInstance()->getProducts()));
        $this->render([
            'layout' => 'index'
        ]);
    }

    private function splitByRows($products, $countInRow = 4) {
        $res = [];
        for ($i = 0; $i < count($products); $i++) {
            $res[intval(floor($i / $countInRow))][] = $products[$i];
        }
        return $res;
    }
}
