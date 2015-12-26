<?php

namespace ph\phAdmin\application\models;

use ph\cookie\CookieStorage;
use ph\exception\PhException;
use ph\phAdmin\application\models\dao\ThemeDAO;

class ThemeModel {
    private static $instance = null;
    private static $COOKIE_NAME = 'phAdmin_theme';
    private $themeDAO;

    private function __construct() {
        $this->themeDAO = new ThemeDAO();
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getAll() {
        return $this->themeDAO->getNames();
    }

    public function getCurrentTheme() {
        return CookieStorage::get(self::$COOKIE_NAME, $this->getDefaultTheme());
    }

    public function getCurrentThemeFile() {
        return $this->themeDAO->getFile($this->getCurrentTheme());
    }

    public function setTheme($theme) {
        if (!$this->themeDAO->exist($theme)) {
            throw new PhException("There is no defined theme with name '$theme'");
        }
        CookieStorage::add(self::$COOKIE_NAME, $theme);
    }

    public function setDefaultTheme() {
        CookieStorage::delete(self::$COOKIE_NAME);
    }

    public function getDefaultTheme() {
        return $this->themeDAO->getNames()[0];
    }
}
