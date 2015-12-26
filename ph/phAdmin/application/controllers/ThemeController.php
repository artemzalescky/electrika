<?php

namespace ph\phAdmin\application\controllers;

use ph\controller\BaseController;
use ph\exception\PhException;
use ph\phAdmin\application\models\ThemeModel;
use ph\sessions\flash\FlashMessageStorage as messages;

class ThemeController extends BaseController {

    public function index() {
        $this->setViewVariable('currentTheme', ThemeModel::getInstance()->getCurrentTheme());
        $this->render();
    }

    public function change() {
        $this->setViewVariable('themes', ThemeModel::getInstance()->getAll());
        $this->setViewVariable('currentTheme', ThemeModel::getInstance()->getCurrentTheme());
        $this->render();
    }

    public function update() {
        if (!$this->isPostRequest()) exit;

        $theme = $this->param('theme');
        try {
            ThemeModel::getInstance()->setTheme($theme);
            messages::add('Theme_ThemeChanged', ['name' => $theme], 'success');
            $this->systemRedirect("/theme");
        } catch (PhException $e) {
            messages::add('Theme_ThemeNotFound', ['name' => $theme], 'error');
            $this->systemRedirect("/theme");
        }
    }

    public function setDefault() {
        if (!$this->isPostRequest()) exit;

        ThemeModel::getInstance()->setDefaultTheme();
        messages::add('Theme_ThemeRestored', ['name' => ThemeModel::getInstance()->getDefaultTheme()], 'success');
        $this->systemRedirect('/theme');
    }
}
