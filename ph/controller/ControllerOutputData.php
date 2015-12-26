<?php

namespace ph\controller;

class ControllerOutputData {
    private $data;

    public function get($name) {
        return $this->data[$name];
    }

    public function set($name, $value) {
        $this->data[$name] = $value;
    }

    public function getData() {
        return $this->data;
    }

    public function isEmpty() {
        return empty($this->data);
    }
}
