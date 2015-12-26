<?php

namespace ph\logging;

use config\Config;
use ph\utils\StringBuilder;

class ExceptionLogger {
    private static $instance = null;

    private $exceptionRender;
    private $exceptionFileLogging;

    private function __construct() {
        $this->exceptionRender = Config::isErrorRender();
        $this->exceptionFileLogging = Config::isErrorFileLogging();

        set_exception_handler(array($this, 'handleException'));
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

    public function handleException($ex) {
        if ($this->exceptionRender) {
            $this->renderException($ex);
        } else {
            Logger::renderServerCrash();
        }
        if ($this->exceptionFileLogging) {
            $this->logExceptionToFile($ex);
        }
    }

    private function renderException($ex) {
        echo $this->generateHtmlForException($ex);
    }

    private function generateHtmlForException($ex, $isCause = false) {
        if (empty($ex)) return "";
        $exCode = $ex->getCode();
        $prevEx = $ex->getPrevious();
        $message = new StringBuilder();
        $message->append('<pre style="' . $this->getExceptionBlockStyles($isCause) . '">')
            ->appendIf($isCause, 'Caused by ')
            ->append($this->getBoldText(get_class($ex), '#1623bb'))
            ->append(' in line <b>' . $ex->getLine() . '</b> of file ' . $ex->getFile() . '<br>')
            ->appendIf($ex->getMessage(), '# ' . $this->getBoldText($ex->getMessage(), '#bb1d13'))
            ->appendIf(!empty($exCode), ' [code = ' . $ex->getCode() . ']')
            ->append('<br>')
            ->appendIf(!empty($prevEx), $this->generateHtmlForException($ex->getPrevious(), true))
            ->append('</pre>');
        return $message->toString();
    }

    private function getExceptionBlockStyles($isCause = false) {
        $base = "border:none; background-color:white; color:black; margin:5px; padding:0; ";
        if ($isCause) {
            return $base . " border-left:1px solid #ccc; margin-left:15px; padding: 5px 0 0 5px";
        }
        return $base . " border:1px solid #bb1d13; padding: 5px 0 5px 5px";
    }

    private function getBoldText($text, $color) {
        return '<span style="color:' . $color . '; font-weight: 800">' . $text . '</span>';
    }

    private function logExceptionToFile($ex) {
        // TODO ... implement
    }

    private function __clone() { }
}
