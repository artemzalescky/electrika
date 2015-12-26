<?php

namespace ph\phAdmin\application\controllers;

use ph\controller\BaseController;
use ph\sessions\flash\FlashMessageStorage as messages;

class IndexController extends BaseController {

    public function index() {
        messages::addGroup('info', ['Welcome' => 1]);
        $this->render();
    }
}
