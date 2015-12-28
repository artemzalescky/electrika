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
        $productPageInfo = null;
        if (!empty($products)) {
            ProductModel::getInstance()->calculateFullProductsUrl($products, $currentCatalog['fullUrl']);
            $productPageInfo = $this->getProductPageInfo($products);
            $products = array_slice($products, $productPageInfo['startIndex'], min(
                $productPageInfo['countPerPage'],
                count($products) - ($productPageInfo['currentPage'] - 1) * $productPageInfo['countPerPage'])
            );
        }

        $this->setViewVariable('currentCatalog', $currentCatalog);
        $this->setViewVariable('pathToCatalog', $pathToCatalog);
        $this->setViewVariable('nearestChildren', $nearestChildren);
        $this->setViewVariable('mainCatalogs', CatalogModel::getInstance()->getNearestChildren(0));
        $this->setViewVariable('products', $products);
        $this->setViewVariable('productPageInfo', $productPageInfo);
        $this->render();
    }

    private function getProductPageInfo($products) {
        if (empty($products)) {
            return null;
        }

        $countPerPage = 12;
        $pagesCount = ceil(count($products) / $countPerPage);
        $currentPage = !empty($this->param('page')) ? intval($this->param('page')) : 1;
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        if ($currentPage * $countPerPage > count($products)) {
            $currentPage = $pagesCount;
        }
        $startIndex = ($currentPage - 1) * $countPerPage;

        $productPageInfo = [];
        $productPageInfo['countPerPage'] = $countPerPage;
        $productPageInfo['currentPage'] = $currentPage;
        $productPageInfo['pagesCount'] = $pagesCount;
        $productPageInfo['startIndex'] = $startIndex;

        return $productPageInfo;
    }
}
