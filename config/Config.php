<?php

namespace config;

use ph\constants\Environment;

class Config {

    private static $properties = [

        //  ------------- path ----------------
        'app.basePath' => '/electrika/',

        //  ------------- db ----------------
        'db.use' => true,
        'db.host' => '127.0.0.1',
        'db.user' => 'root',
        'db.password' => '',
        'db.name' => 'electrika',

        // ------------- session ----------------
        'session.use' => true,

        //  ------------- locale ----------------
        'locale.use' => true,
        'locale.defaultLang' => 'ru',

        //  ------------- environment ----------------
        'env' => Environment::DEVELOPMENT,

        'env.development.error.render' => true,
        'env.development.error.fileLogging' => true,

        'env.production.error.render' => false,
        'env.production.error.fileLogging' => false
    ];

    //  ------------- applying configuration ----------------
    public static function apply() {
        date_default_timezone_set('Europe/Minsk');
    }

    //  ------------- path ----------------

    public static function getBasePath() {
        return self::getProperty('app.basePath', '/');
    }

    //  ------------- db ----------------

    private static function getProperty($name, $defaultValue = null) {
        return isset(self::$properties[$name]) ? self::$properties[$name] : $defaultValue;
    }

    public static function useDatabase() {
        return self::getProperty('db.use', false);
    }

    public static function getDatabaseDialect() {
        return self::getProperty('db.dialect', 'mysql');
    }

    public static function getDatabaseHost() {
        return self::getProperty('db.host', '127.0.0.1');
    }

    public static function getDatabasePort() {
        return self::getProperty('db.port', '3306');
    }

    public static function getDatabaseUser() {
        return self::getProperty('db.user');
    }

    public static function getDatabasePassword() {
        return self::getProperty('db.password');
    }

    public static function getDatabaseName() {
        return self::getProperty('db.name');
    }

    public static function getDatabaseCharset() {
        return self::getProperty('db.charset', 'utf8');
    }

    // ------------- session ----------------

    public static function useSession() {
        return self::getProperty('session.use', false);
    }

    // ------------- locale ----------------

    public static function useLocale() {
        return self::getProperty('locale.use', false);
    }

    public static function getDefaultLang() {
        return self::getProperty('locale.defaultLang', 'ru');
    }

    // ------------- environment ----------------

    public static function isProductionEnvironment() {
        return self::getEnvironment() === Environment::PRODUCTION;
    }

    public static function getEnvironment() {
        return self::getProperty('env');
    }

    public static function getErrorLoggingLevel() {
        if (self::isDevelopmentEnvironment()) {
            return E_ALL & ~E_NOTICE;
        }
        return E_ALL & ~E_NOTICE;
    }

    public static function isDevelopmentEnvironment() {
        return self::getEnvironment() === Environment::DEVELOPMENT;
    }

    public static function isErrorRender() {
        if (self::isDevelopmentEnvironment()) {
            return self::getProperty('env.development.error.render', false);
        }
        return self::getProperty('env.production.error.render', false);
    }

    public static function isErrorFileLogging() {
        if (self::isDevelopmentEnvironment()) {
            return self::getProperty('env.development.error.fileLogging', false);
        }
        return self::getProperty('env.production.error.fileLogging', false);
    }
}
