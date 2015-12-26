<?php

namespace ph\phAdmin\application\models;

use config\Config;
use ph\cookie\CookieStorage;

class LocaleModel {
    private static $COOKIE_NAME = 'locale';

    private $lang;
    private $defaultLang;
    private $dictionaries;

    public function __construct($lang, $defaultLang) {
        if (empty($lang)) {
            $lang = CookieStorage::get('locale', Config::getDefaultLang());
        }
        $this->lang = $lang;
        $this->defaultLang = $defaultLang;
    }

    public function getLang() {
        return $this->lang;
    }

    public function setLang($lang) {
        $this->lang = $lang;
    }

    public static function saveLang($lang) {
        CookieStorage::add(self::$COOKIE_NAME, $lang);
    }

    public static function resetLang() {
        CookieStorage::delete(self::$COOKIE_NAME);
    }

    public function addDictionary($dictionary) {
        $this->dictionaries[] = $dictionary;
    }

    public function __get($value) {
        return $this->getText($value);
    }

    public function getMessage($name, $values = null) {
        $message = $this->getText('Ph_Message_' . $name);
        if (!empty($values) && is_array($values)) {
            foreach ($values as $k => $v) {
                $message = str_replace('#{' . $k . '}' , $v, $message);
            }
        }
        return $message;
    }

    public function getText($textName) {
        foreach ($this->dictionaries as $dictionary) {
            $text = $dictionary[$this->lang][$textName];
            if (isset($text)) {
                return $text;
            }
        }
        foreach ($this->dictionaries as $dictionary) {
            $text = $dictionary[$this->defaultLang][$textName];
            if (isset($text)) {
                return $text;
            }
        }
        return $textName;
    }
}
