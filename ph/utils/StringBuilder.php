<?php

namespace ph\utils;

class StringBuilder {
    private $buffer;

    public function __construct($str = "") {
        $this->buffer = $str;
    }

    public function appendIf($condition, $str) {
        if ($condition) {
            $this->append($str);
        }
        return $this;
    }

    public function append($str) {
        $this->buffer .= $str;
        return $this;
    }

    public function deleteLast($charCount = 1) {
        $this->delete($this->length() - $charCount);
        return $this;
    }

    public function delete($start = 0, $length = null) {
        if ($length === null) {
            $length = strlen($this->buffer);
        }
        if ($start < 0) {
            $start = 0;
        }
        $copy = $this->buffer;
        $this->buffer = substr($copy, 0, $start) . substr($copy, $start + $length);
        return $this;
    }

    public function length() {
        return strlen($this->buffer);
    }

    public function clear() {
        $this->buffer = "";
        return $this;
    }

    public function toString() {
        return $this->__toString();
    }

    public function __toString() {
        return $this->buffer;
    }
}
