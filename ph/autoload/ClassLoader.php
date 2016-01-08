<?php

namespace ph\autoload;

class ClassLoader {

    public static function loadFromNamespace($className) {
        try {
            include_once(self::getClassPathFromClassName($className));
        } catch (\ErrorException $ignored) { }
    }

    public static function getClassPathFromClassName($className) {
        // TODO fix for all systems
        // return $_SERVER['DOCUMENT_ROOT'] . str_replace('\\', '/', '/' . $className . '.php');
        return str_replace('\\', '/', '/' . $className . '.php');
    }
}
