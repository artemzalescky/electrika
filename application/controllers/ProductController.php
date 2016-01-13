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
        $product['_imageExist'] = ProductModel::getInstance()->imageExist($product['catalogId'], $product['id']);

        if (empty($product)) {
            $this->redirect('404');
        }

        $this->setViewVariable('currentCatalog', $currentCatalog);
        $this->setViewVariable('pathToCatalog', $pathToCatalog);
        $this->setViewVariable('product', $product);
        $this->render();
    }

    public function getById($catalogId, $productId) {
        $catalog = CatalogModel::getInstance()->getById($catalogId);
        $this->redirect('/product/' . $catalog['url'] . '/' . $productId);
    }
}
