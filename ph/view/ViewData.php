<?php

namespace ph\view;

use ph\config\Settings;

class ViewData {
    private $routeData;
    private $layoutPath;
    private $viewPath;

    public function __construct($routeData) {
        $this->routeData = $routeData;
        $this->layoutPath = ViewPathResolver::getLayoutPath($routeData, Settings::DEFAULT_LAYOUT_NAME);
        $this->viewPath = ViewPathResolver::getViewPath($routeData);
    }

    public function acceptParams($params) {
        if (!empty($params)) {
            if (isset($params['layout'])) {
                if (empty($params['layout'])) {
                    $this->layoutPath = null;
                } else {
                    $this->layoutPath = ViewPathResolver::getLayoutPath($this->routeData, $params['layout']);
                }
            }
            if (!empty($params['controller']) || !empty($params['action'])) {
                $routeDataCopy = clone $this->routeData;
                if (!empty($params['controller'])) {
                    $routeDataCopy->setControllerName($params['controller']);
                }
                if (!empty($params['action'])) {
                    $routeDataCopy->setActionName($params['action']);
                }
                $this->viewPath = ViewPathResolver::getViewPath($routeDataCopy);
            }
            if (isset($params['template'])) {
                $routeDataCopy = clone $this->routeData;
                $routeDataCopy->setControllerName('_template');
                $routeDataCopy->setActionName($params['template']);
                $this->viewPath = ViewPathResolver::getViewPath($routeDataCopy);
            }
        }
    }

    public function hasLayout() {
        $layoutPath = $this->getLayoutPath();
        return !empty($layoutPath);
    }

    public function getLayoutPath() {
        return $this->layoutPath;
    }

    public function getViewPath() {
        return $this->viewPath;
    }
}
