<?php

namespace ph\controller;

use ph\config\Settings;
use ph\routing\Router;
use ph\view\ViewData;

class BaseController {
    protected $inputData;
    protected $outputData;
    protected $viewData;

    public function __construct($inputData) {
        $this->inputData = $inputData;
        $this->outputData = new ControllerOutputData();
        $this->viewData = new ViewData($this->inputData['routeData']);
    }

    // called only from controller
    public function render($_private_params = null) {
        $this->viewData->acceptParams($_private_params);
        $this->checkViewExist($this->viewData);

        if (!$this->outputData->isEmpty()) {
            foreach ($this->outputData->getData() as $_private_key => $_private_value) {
                $$_private_key = $_private_value;
            }
        }

        $_private_uiHelperName = Settings::UI_HELPER_NAME;
        $$_private_uiHelperName = $this->inputData['uiHelper'];
        $GLOBALS[$_private_uiHelperName] = $this->inputData['uiHelper'];

        if ($this->viewData->hasLayout()) {
            include($this->viewData->getLayoutPath());
        } else {
            include($this->viewData->getViewPath());
        }
    }

    // called only from controller
    public function renderStatic() {
        $this->render();
    }

    // called from view or controller
    // draws part of content (file from 'controller/action/_template' folder)
    public function renderContent($_private_params = null) {
        $_private_viewData = clone $this->viewData;  // only here, not in render()
        $_private_viewData->acceptParams($_private_params);
        $this->checkViewExist($_private_viewData);

        if (!$this->outputData->isEmpty()) {
            foreach ($this->outputData->getData() as $_private_key => $_private_value) {
                $$_private_key = $_private_value;
            }
        }

        $_private_uiHelperName = Settings::UI_HELPER_NAME;
        $$_private_uiHelperName = $this->inputData['uiHelper'];
        $GLOBALS[$_private_uiHelperName] = $this->inputData['uiHelper'];

        include($_private_viewData->getViewPath());
    }

    public function renderTemplate($name) {
        $this->renderContent([
            'template' => trim($name, '/')
        ]);
    }

    public function renderJson($object, $charset = 'UTF-8') {
        header("Content-Type: application/json ; charset=$charset");
        echo json_encode($object);
    }

    private function checkViewExist($viewData) {
        $viewPath = $viewData->getViewPath();
        if (empty($viewPath)) {
            $this->redirect("/404");
        }
    }

    public function getOutputData() {
        return $this->outputData;
    }

    public function setViewVariable($name, $value) {
        $this->outputData->set($name, $value);
    }

    public function redirect($url = "") {
        Router::redirect($url);
    }

    public function redirectBack() {
        Router::redirectBack();
    }

    public function systemRedirect($url = "") {
        Router::systemRedirect($url);
    }

    public function array2ParamString($inputArr, $paramName, $excludedFields = []) {
        $res = '';
        foreach ($inputArr as $k => $v) {
            if (!in_array($k, $excludedFields)) {
                $res .= $paramName . '[' . $k . ']=' . $v . '&';
            }
        }
        return rtrim($res, '&');
    }

    public function getRequestMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isGetRequest() {
        return $this->getRequestMethod() === 'GET';
    }

    public function isPostRequest() {
        return $this->getRequestMethod() === 'POST';
    }

    public function hasParam($name) {
        return $this->hasRequestParameter($name, $_REQUEST);
    }

    public function hasParamGet($name) {
        return $this->hasRequestParameter($name, $_GET);
    }

    public function hasParamPost($name) {
        return $this->hasRequestParameter($name, $_POST);
    }

    public function param($name) {
        return $this->getRequestParameter($name, $_REQUEST);
    }

    public function paramGet($name) {
        return $this->getRequestParameter($name, $_GET);
    }

    public function paramPost($name) {
        return $this->getRequestParameter($name, $_POST);
    }

    private function hasRequestParameter($name, $array) {
        return array_key_exists($name, $array);
    }

    private function getRequestParameter($name, $array) {
        return $array[$name];
    }
}
