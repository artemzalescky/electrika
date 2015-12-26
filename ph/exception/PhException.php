<?php

namespace ph\exception;

class PhException extends \RuntimeException {
    private $errors;

    public static function throwErrors($errors) {
        $e = new self();
        $e->setErrors($errors);
        throw $e;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function setErrors($errors) {
        $this->errors = $errors;
    }
}
