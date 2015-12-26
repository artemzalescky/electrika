<?php

namespace ph\utils;

use ph\routing\RouteData;

class ClassNameResolver {

    public static function getControllerClassName($routeData) {
        $controllerName = StringUtil::startWithUpperCase($routeData->getControllerName()) . 'Controller';
        if (RouteData::isSystemRequest($routeData)) {
            return "\\ph\\phAdmin\\application\\controllers\\" . $controllerName;
        } else if (RouteData::isUserRequest($routeData)) {
            return "\\application\\controllers\\" . $controllerName;
        }
        return null;
    }
}
