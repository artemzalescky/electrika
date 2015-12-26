<?php

namespace ph\helpers;

use ph\config\Settings;
use ph\sessions\flash\FlashMessagesAccessorImpl;

class UiHelper extends HtmlHelper {
    private $locale;
    private $flashMessagesAccessor;

    public function __construct($locale) {
        $this->locale = $locale;
        $this->flashMessagesAccessor = new FlashMessagesAccessorImpl();
    }

    public function setLocale($locale) {
        $this->locale = $locale;
    }

    public function __get($name) {
        if ($name === Settings::UI_HELPER_LOCALE_FIELD_NAME) {
            return $this->locale;
        }
        if ($name === Settings::UI_HELPER_FLASH_FIELD_NAME) {
            return $this->flashMessagesAccessor;
        }
        return null;
    }

    public function renderAllMessages() {
        foreach ($this->messages->getGroup('error') as $k => $v) {
            $this->message_error($this->lang->getMessage($k, $v));
        }
        foreach ($this->messages->getGroup('warning') as $k => $v) {
            $this->message_warning($this->lang->getMessage($k, $v));
        }
        foreach ($this->messages->getGroup('success') as $k => $v) {
            $this->message_success($this->lang->getMessage($k, $v));
        }
        foreach ($this->messages->getGroup('info') as $k => $v) {
            $this->message_info($this->lang->getMessage($k, $v));
        }
        return $this;
    }
}
