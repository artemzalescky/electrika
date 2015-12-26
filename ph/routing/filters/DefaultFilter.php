<?php

namespace ph\routing\filters;

use ph\routing\RouteData;

class DefaultFilter extends Filter {

    // standard routing: /controller/action/param1/param2/../paramN
    public function filter($route) {
        $tokenArr = self::getTokenArr($route);

        $controllerName = $this->getNotEmptyValue($tokenArr[0], "index");
        $actionName = $this->getNotEmptyValue($tokenArr[1], "index");
        $pathParams = $this->fillPathParamArr($tokenArr, 2);
        return new RouteData($controllerName, $actionName, $pathParams);
    }
}
