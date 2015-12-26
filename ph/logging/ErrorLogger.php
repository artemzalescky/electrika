<?php

namespace ph\logging;

use config\Config;

class ErrorLogger {
    private static $instance = null;

    private $errorLevel;
    private $errorRender;
    private $errorFileLogging;

    private function __construct() {
        $this->errorLevel = Config::getErrorLoggingLevel();
        $this->errorRender = Config::isErrorRender();
        $this->errorFileLogging = Config::isErrorFileLogging();

        set_error_handler(array($this, 'handleError'));
        register_shutdown_function(array($this, 'handleFatalError'));
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

    public function handleError($errLevel, $errMessage, $errFile, $errLine) {
        if ($this->errorRender && $errLevel & $this->errorLevel) {
            throw new \ErrorException("[" . $this->getErrorType($errLevel) . "] " . $errMessage, 0, $errLevel, $errFile, $errLine);
        }
    }

    private function getErrorType($errLevel) {
        if ($errLevel & E_ERROR) return 'Error';
        if ($errLevel & E_WARNING) return 'Warning';
        if ($errLevel & E_PARSE) return 'Parse error';
        if ($errLevel & E_NOTICE) return 'Notice';
        if ($errLevel & E_CORE_ERROR) return 'Core error';
        if ($errLevel & E_CORE_WARNING) return 'Core warning';
        if ($errLevel & E_COMPILE_ERROR) return 'Compile error';
        if ($errLevel & E_COMPILE_WARNING) return 'Compile warning';
        if ($errLevel & E_USER_ERROR) return 'User error';
        if ($errLevel & E_USER_WARNING) return 'User warning';
        if ($errLevel & E_USER_NOTICE) return 'User notice';
        if ($errLevel & E_STRICT) return 'Strict error';
        if ($errLevel & E_RECOVERABLE_ERROR) return 'Recoverable error';
        if ($errLevel & E_DEPRECATED) return 'Deprecated error';
        if ($errLevel & E_USER_DEPRECATED) return 'User deprecated error';
        return 'Undefined error';
    }

    public function handleFatalError() {
        if ($error = error_get_last() AND $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            ob_end_clean();
            if ($this->errorRender) {
                echo $this->generateHtmlForError($error['type'], $error['message'], $error['file'], $error['line']);
            } else {
                Logger::renderServerCrash();
            }
        } else {
            ob_end_flush();
        }
    }

    private function generateHtmlForError($errLevel, $errMessage, $errFile, $errLine) {
        $message = '<pre style="' . $this->getErrorBlockStyles() . '">';
        $message .= $this->getBoldText($this->getErrorType($errLevel), '#1623bb');
        $message .= ' in line <b>' . $errLine . '</b> of file ' . $errFile . '<br>';
        $message .= '# ' . $this->getBoldText($errMessage, '#bb1d13');
        $message .= '</pre>';
        return $message;
    }

    private function getErrorBlockStyles() {
        return "border:none; background-color:white; color:black; margin:5px; padding:0; border:1px solid #bb1d13; padding: 5px 0 5px 5px";
    }

    private function getBoldText($text, $color) {
        return '<span style="color:' . $color . '; font-weight: 800">' . $text . '</span>';
    }

    private function __clone() { }

    private function logErrorToFile($errLevel, $errMessage, $errFile, $errLine) {
        // TODO ... implement
    }
}
