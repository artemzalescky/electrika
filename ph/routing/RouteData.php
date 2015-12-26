<?php

namespace ph\routing;

use ph\constants\RequestType;

class RouteData {
    private $controllerName;
    private $actionName;
    private $pathParams;
    private $requestType;

    public function __construct($controllerName = null, $actionName = null, $pathParams = null, $requestType = null) {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->pathParams = $pathParams;
        $this->requestType = !empty($requestType) ? $requestType : RequestType::USER;
    }

    public function getControllerName() {
        return $this->controllerName;
    }

    public function setControllerName($controllerName) {
        $this->controllerName = $controllerName;
    }

    public function getActionName() {
        return $this->actionName;
    }

    public function setActionName($actionName) {
        $this->actionName = $actionName;
    }

    public function getPathParams() {
        return $this->pathParams;
    }

    public function setPathParams($pathParams) {
        $this->pathParams = $pathParams;
    }

    public function getRequestType() {
        return $this->requestType;
    }

    public function setRequestType($requestType) {
        $this->requestType = $requestType;
    }

    public static function isSystemRequest($routeData) {
        return $routeData->getRequestType() === RequestType::SYSTEM;
    }

    public static function isUserRequest($routeData) {
        return $routeData->getRequestType() === RequestType::USER;
    }

    public static function isValid($routeData) {
        return !empty($routeData)
            && get_class($routeData) == get_class(new self)
            && !empty($routeData->getRequestType())
            && !empty($routeData->getControllerName())
            && !empty($routeData->getActionName());
    }
}
