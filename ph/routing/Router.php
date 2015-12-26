<?php

namespace ph\routing;

use config\Config;
use config\Routes;
use ph\config\Settings;
use ph\routing\filters\SystemFilter;
use ph\routing\filters\DefaultFilter;
use ph\utils\StringUtil;

class Router {
    private $systemFilter;
    private $customFilter;
    private $defaultFilter;

    public function __construct() {
        $this->systemFilter = new SystemFilter();
        $this->customFilter = new Routes();
        $this->defaultFilter = new DefaultFilter();
    }

    public function resolve($route) {
        // system routing
        $systemRouteData = $this->systemFilter->filter($route);
        if (RouteData::isValid($systemRouteData)) {
            return $systemRouteData;
        }

        // custom routing (add verification to situations where url must be handled in special way)
        $customRouteData = $this->customFilter->filter($route);
        if (RouteData::isValid($customRouteData)) {
            return $customRouteData;
        }

        // default routing
        return $this->defaultFilter->filter($route);
    }

    public static function redirect($url = "") {
        if (StringUtil::isAbsoluteUrl($url)) {
            header("Location: " . $url);
            exit;
        } else {
            header("Location: " . Config::getBasePath() . trim($url, "/"));
            exit;
        }
    }

    public static function systemRedirect($url = "") {
        header("Location: " . Config::getBasePath() . Settings::SYSTEM_REQUEST_PREFIX . '/' . trim($url, "/"));
        exit;
    }

    public static function redirectBack() {
        self::redirect($_SERVER['HTTP_REFERER']);
    }
}
