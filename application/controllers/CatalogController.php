<?php

namespace application\controllers;

use application\models\CatalogModel;
use ph\controller\BaseController;

class CatalogController extends BaseController {

    public function show($catalogPathTokens) {
        $lastUrlPart = !empty($catalogPathTokens) ? $catalogPathTokens[count($catalogPathTokens) - 1] : null;
        $catalogPathToCatalog = CatalogModel::getInstance()->getPathToCatalogByUrl($lastUrlPart);
        $this->setViewVariable('catalogPathToCatalog', $catalogPathToCatalog);
        $this->render();
    }
}
