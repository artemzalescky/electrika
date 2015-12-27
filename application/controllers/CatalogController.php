<?php

namespace application\controllers;

use application\models\CatalogModel;
use application\models\ProductModel;
use ph\controller\BaseController;

class CatalogController extends BaseController {

    public function show($catalogPathTokens) {
        $lastUrlPart = !empty($catalogPathTokens) ? $catalogPathTokens[count($catalogPathTokens) - 1] : null;

        if (!empty($catalogPathTokens) && !CatalogModel::getInstance()->catalogExistForUrl($lastUrlPart)) {
            $this->redirect('404');
        }

        $pathToCatalog = CatalogModel::getInstance()->getPathToCatalogByUrl($lastUrlPart);
        CatalogModel::getInstance()->calculateFullCatalogUrl($pathToCatalog);
        $currentCatalog = $pathToCatalog[count($pathToCatalog) - 1];
        $nearestChildren = CatalogModel::getInstance()->getNearestChildren($currentCatalog['id']);

        $products = ProductModel::getInstance()->get($currentCatalog['id']);
        ProductModel::getInstance()->calculateFullProductsUrl($products, $currentCatalog['fullUrl']);

        $this->setViewVariable('currentCatalog', $currentCatalog);
        $this->setViewVariable('pathToCatalog', $pathToCatalog);
        $this->setViewVariable('nearestChildren', $nearestChildren);
        $this->setViewVariable('mainCatalogs', CatalogModel::getInstance()->getNearestChildren(0));
        $this->setViewVariable('products', $products);
        $this->render();
    }
}
