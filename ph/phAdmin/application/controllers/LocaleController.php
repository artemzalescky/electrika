<?php

namespace ph\phAdmin\application\controllers;

use ph\controller\BaseController;
use ph\phAdmin\application\models\LocaleModel;

class LocaleController extends BaseController {
    public function change($lang) {
        LocaleModel::saveLang($lang);
        $this->redirectBack();
    }
}
