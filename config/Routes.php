<?php

namespace config;

use ph\routing\filters\Filter;
use ph\routing\RouteData;

// custom routing (add verification to situations where url must be handled in special way)
// if not set - standard routing: /controller/action/param1/param2/../paramN

class Routes extends Filter {

    public function filter($route) {
        $tokenArr = self::getTokenArr($route);

        if (count($tokenArr) > 0 && $tokenArr[0] == 'catalog') {
            $controllerName = 'catalog';
            $actionName = 'show';
            $pathParams = [$this->fillPathParamArr($tokenArr, 1)];
            return new RouteData($controllerName, $actionName, $pathParams);
        }

        if (count($tokenArr) == 4 && $tokenArr[0] == 'product' && $tokenArr[1] == 'id') {
            $controllerName = 'product';
            $actionName = 'getById';
            $pathParams = $this->fillPathParamArr($tokenArr, 2);
            return new RouteData($controllerName, $actionName, $pathParams);
        }

        if (count($tokenArr) > 0 && $tokenArr[0] == 'product') {
            $controllerName = 'product';
            $actionName = 'show';
            $pathParams = [$this->fillPathParamArr($tokenArr, 1)];
            return new RouteData($controllerName, $actionName, $pathParams);
        }

        return null;
    }
}
