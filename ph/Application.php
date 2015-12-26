<?php

namespace ph;

use config\Config;
use config\Dictionary;
use ph\locale\Dictionary as SystemDictionary;
use ph\db\Database;
use ph\phAdmin\application\models\LocaleModel;
use ph\sessions\SessionStorage;
use ph\utils\ClassNameResolver;
use ph\helpers\UiHelper;
use ph\routing\Router;

class Application {
    private $locale;

    private $routeData;
    private $controller;

    public function __construct() {
        Config::apply();
        $this->setupSession();
        $this->setupRouteData();
        $this->setupLocale();
        $this->setupDatabaseConnection();
    }

    public function run() {
        $controllerClassName = ClassNameResolver::getControllerClassName($this->routeData);
        if (!$this->controllerExist($controllerClassName)) {
            $controllerClassName = '\ph\controller\StaticContentController';
        }
        $this->controller = new $controllerClassName($this->getControllerInputData());
        $this->runController();
    }

    private function setupRouteData() {
        $router = new Router();
        $route = isset($_GET['ph_route']) ? $_GET['ph_route'] : '/';
        $this->routeData = $router->resolve($route);
    }

    private function setupLocale() {
        if (Config::useLocale()) {
            $this->locale = new LocaleModel(null, Config::getDefaultLang());
            $this->locale->addDictionary(SystemDictionary::getLexicon());
            $this->locale->addDictionary(Dictionary::getLexicon());
        }
    }

    private function setupSession() {
        if (Config::useSession()) {
            SessionStorage::initialize();
        }
    }

    private function setupDatabaseConnection() {
        if (Config::useDatabase()) {
            Database::getInstance()->connect(Config::getDatabaseDialect(), Config::getDatabaseHost(), Config::getDatabasePort(),
                Config::getDatabaseUser(), Config::getDatabasePassword(), Config::getDatabaseName(), Config::getDatabaseCharset());
        }
    }

    private function controllerExist($controllerClassName) {
        return class_exists($controllerClassName);
    }

    private function runController() {
        $actionName = $this->routeData->getActionName();
        $pathParams = $this->routeData->getPathParams();

        if (!method_exists($this->controller, $actionName)) {
            $actionName = 'renderStatic';
        }

        if (!empty($pathParams) && is_array($pathParams)) {
            call_user_func_array(array($this->controller, $actionName), $pathParams);
        } else {
            $this->controller->$actionName();
        }
    }

    private function getControllerInputData() {
        return [
            'routeData' => $this->routeData,
            'uiHelper' => new UiHelper($this->locale)
        ];
    }
}
