<?php

namespace config;

class Dictionary {

    private static $lexicon = array(
        "ru" => array(
            "NavBar_Home" => "Главная",
            "NavBar_AdminPanel" => "Панель администрирования"
        ),
        "en" => array(
            "NavBar_Home" => "Home",
            "NavBar_AdminPanel" => "Admin panel"
        )
    );

    public static function getLexicon() {
        return self::$lexicon;
    }
}
