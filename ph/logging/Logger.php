<?php

namespace ph\logging;

class Logger {
    private static $instance = null;

    private function __construct() {
        ExceptionLogger::initialize();
        ErrorLogger::initialize();
    }

    public static function initialize() {
        self::getInstance();
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public static function renderServerCrash() {
        ob_end_clean();
        echo "<div style='margin-top:10%; text-align:center'>Server is temporarily unavailable<br><br>Please try again later</div>";
    }

    private function __clone() { }
}
