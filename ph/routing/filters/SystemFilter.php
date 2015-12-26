<?php

namespace ph\routing\filters;

use ph\config\Settings;
use ph\constants\RequestType;
use ph\phAdmin\application\models\AuthModel;
use ph\routing\RouteData;
use ph\routing\Router;
use ph\utils\StringUtil;

class SystemFilter extends Filter {
    private $allPermittedRoutes = [
        'auth/*',
        'locale/*'
    ];

    private $guestPermittedRoutes = [
        'index/index',
        'theme/*'
    ];

    public function filter($route) {
        $tokenArr = self::getTokenArr($route);

        if (self::isSystemController($tokenArr[0])) {
            $requestType = RequestType::SYSTEM;
            $controllerName = $this->getNotEmptyValue($tokenArr[1], "index");
            $actionName = $this->getNotEmptyValue($tokenArr[2], "index");
            $pathParams = $this->fillPathParamArr($tokenArr, 3);
            $routeData = new RouteData($controllerName, $actionName, $pathParams, $requestType);

            $this->checkPermissions($routeData);

            return $routeData;
        }
        return null;
    }

    private static function isSystemController($firstRouteToken) {
        return !empty($firstRouteToken) && StringUtil::equalIgnoreCase($firstRouteToken, Settings::SYSTEM_REQUEST_PREFIX);
    }

    private function checkPermissions($routeData) {
        if ($this->isAllPermittedRoute($routeData)) {
            return;
        }
        if (AuthModel::getInstance()->isGuestLoggedIn() && $this->isGuestPermittedRoute($routeData)) {
            return;
        }
        if (AuthModel::getInstance()->isAdminLoggedIn()) {
            return;
        }
        Router::systemRedirect('/auth');
    }

    private function isAllPermittedRoute($routeData) {
        return $this->isInPermRoutes($routeData, $this->allPermittedRoutes);
    }

    private function isGuestPermittedRoute($routeData) {
        return $this->isInPermRoutes($routeData, $this->guestPermittedRoutes);
    }

    private function isInPermRoutes($routeData, $permRoutes) {
        foreach ($permRoutes as $permRoute) {
            $tokenArr = explode('/', $permRoute);
            $permController = $tokenArr[0];
            $permAction = $tokenArr[1];
            if ($permController === $routeData->getControllerName()) {
                if ($permAction === '*' || $permAction === $routeData->getActionName()) {
                    return true;
                }
            }
        }
        return false;
    }
}
