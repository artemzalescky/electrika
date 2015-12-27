<?php

namespace application\controllers;

use application\models\CatalogModel;
use application\models\ProductModel;
use ph\controller\BaseController;

class ProductController extends BaseController {

    public function show($catalogPathTokens) {
        $catalogUrl = !empty($catalogPathTokens) ? $catalogPathTokens[count($catalogPathTokens) - 2] : null;
        $productId = !empty($catalogPathTokens) ? $catalogPathTokens[count($catalogPathTokens) - 1] : null;

        if (!empty($catalogPathTokens) && !CatalogModel::getInstance()->catalogExistForUrl($catalogUrl)) {
            $this->redirect('404');
        }

        $pathToCatalog = CatalogModel::getInstance()->getPathToCatalogByUrl($catalogUrl);
        CatalogModel::getInstance()->calculateFullCatalogUrl($pathToCatalog);
        $currentCatalog = $pathToCatalog[count($pathToCatalog) - 1];

        $product = ProductModel::getInstance()->getById($currentCatalog['id'], $productId);

        if (empty($product)) {
            $this->redirect('404');
        }

        $this->setViewVariable('currentCatalog', $currentCatalog);
        $this->setViewVariable('pathToCatalog', $pathToCatalog);
        $this->setViewVariable('product', $product);
        $this->render();
    }
}
