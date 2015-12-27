<?php

namespace application\controllers;

use application\models\CatalogModel;
use ph\controller\BaseController;

class CatalogController extends BaseController {

    public function show($catalogPathTokens) {
        $lastUrlPart = !empty($catalogPathTokens) ? $catalogPathTokens[count($catalogPathTokens) - 1] : null;

        if (!empty($catalogPathTokens) && !CatalogModel::getInstance()->catalogExistForUrl($lastUrlPart)) {
            $this->redirect('404');
        }

        $pathToCatalog = CatalogModel::getInstance()->getPathToCatalogByUrl($lastUrlPart);
        $this->calculateFullUrl($pathToCatalog);
        $currentCatalog = $pathToCatalog[count($pathToCatalog) - 1];

        $nearestChildren = CatalogModel::getInstance()->getNearestChildren($currentCatalog['id']);

        $this->setViewVariable('currentCatalog', $currentCatalog);
        $this->setViewVariable('pathToCatalog', $pathToCatalog);
        $this->setViewVariable('nearestChildren', $nearestChildren);
        $this->setViewVariable('mainCatalogs', CatalogModel::getInstance()->getNearestChildren(0));
        $this->render();
    }

    private function calculateFullUrl(&$pathToCatalog) {
        $currentUrl = '';
        for ($i = 0; $i < count($pathToCatalog); $i++) {
            $currentUrl .= '/' . $pathToCatalog[$i]['url'];
            $pathToCatalog[$i]['fullUrl'] = $currentUrl;
        }
    }
}
