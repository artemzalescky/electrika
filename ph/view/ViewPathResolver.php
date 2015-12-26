<?php

namespace ph\view;

use ph\routing\RouteData;
use ph\utils\StringUtil;
use ph\utils\Util;

class ViewPathResolver {
    private static $VIEW_FILE_EXTENSION = 'php';
    
    public static function getViewPath($routeData) {
        $basePath = '';
        if (RouteData::isSystemRequest($routeData)) {
            $basePath = 'ph/phAdmin/application/views/';
        } else if (RouteData::isUserRequest($routeData)) {
            $basePath = 'application/views/';
        }
        return self::getViewPathFromBasePath($routeData, $basePath);
    }

    private static function getViewPathFromBasePath($routeData, $basePath) {
        $lowControllerName = StringUtil::startWithLowerCase($routeData->getControllerName());
        $lowActionName = StringUtil::startWithLowerCase($routeData->getActionName());

        $filePathWithActionName = $basePath . $lowControllerName . "/". $lowActionName . "." . self::$VIEW_FILE_EXTENSION;
        if (file_exists($filePathWithActionName)) {
            return $filePathWithActionName;
        }
        $filePathWithoutActionName = $basePath . $lowControllerName . "." . self::$VIEW_FILE_EXTENSION;
        if (file_exists($filePathWithoutActionName)) {
            return $filePathWithoutActionName;
        }
        return null;
    }

    public static function getLayoutPath($routeData, $layoutName = null) {
        if (Util::isEmpty($layoutName)) {
            return null;
        }
        if (RouteData::isSystemRequest($routeData)) {
            $basePath = 'ph/phAdmin/application/views/_layout/';
        } else {
            $basePath = 'application/views/_layout/';
        }
        $filePath = $basePath . $layoutName . '.' . self::$VIEW_FILE_EXTENSION;
        if (file_exists($filePath)) {
            return $filePath;
        }
        return null;
    }
}
