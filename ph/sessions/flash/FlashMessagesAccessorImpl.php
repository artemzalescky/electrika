<?php

namespace ph\sessions\flash;

class FlashMessagesAccessorImpl implements FlashMessagesAccessor {

    public function add($name, $value, $groupName = null) {
        FlashMessageStorage::add($name, $value, $groupName);
    }

    public function addGroup($groupName, $messages = null) {
        FlashMessageStorage::addGroup($groupName, $messages);
    }

    public function get($name, $groupName = null) {
        return FlashMessageStorage::get($name, $groupName);
    }

    public function safeGet($name, $groupName = null) {
        return FlashMessageStorage::safeGet($name, $groupName);
    }

    public function delete($name, $groupName = null) {
        FlashMessageStorage::delete($name, $groupName);
    }

    public function contains($name, $groupName = null) {
        return FlashMessageStorage::contains($name, $groupName);
    }

    public function getGroup($name) {
        return FlashMessageStorage::getGroup($name);
    }

    public function safeGetGroup($name) {
        return FlashMessageStorage::safeGetGroup($name);
    }

    public function deleteGroup($name) {
        FlashMessageStorage::deleteGroup($name);
    }

    public function clear() {
        FlashMessageStorage::clear();
    }
}
