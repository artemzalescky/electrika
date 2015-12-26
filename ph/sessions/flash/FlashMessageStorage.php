<?php

namespace ph\sessions\flash;

use ph\sessions\SessionStorage;
use ph\utils\Util;

class FlashMessageStorage {
    private static $FLASH_MESSAGE_PREFIX = 'ph_flash_message';
    private static $GROUP_PREFIX = '%';
    private static $VAR_PREFIX = '~';

    public static function add($name, $value, $groupName = null) {
        SessionStorage::add(self::varName($name, $groupName), $value);
    }

    public static function addGroup($groupName, $messages) {
        if (!Util::isEmpty($messages)) {
            foreach ($messages as $k => $v) {
                FlashMessageStorage::add($k, $v, $groupName);
            }
        }
    }

    public static function get($name, $groupName = null) {
        $value = self::safeGet($name, $groupName);
        self::delete($name, $groupName);
        return $value;
    }

    public static function safeGet($name, $groupName = null) {
        return SessionStorage::get(self::varName($name, $groupName));
    }

    public static function delete($name, $groupName = null) {
        SessionStorage::delete(self::varName($name, $groupName));
    }

    public static function contains($name, $groupName = null) {
        return SessionStorage::contains(self::varName($name, $groupName));
    }

    public static function getGroup($name) {
        $res = self::safeGetGroup($name);
        self::deleteGroup($name);
        return $res;
    }

    public static function safeGetGroup($name) {
        $groupVarPrefix = self::groupVarPrefix($name);
        $res = array();
        foreach(SessionStorage::getAll() as $key => $value) {
            if (strpos($key, $groupVarPrefix) === 0) {
                $shortName = substr($key, strlen($groupVarPrefix));
                $res[$shortName] = $value;
            }
        }
        return $res;
    }

    public static function deleteGroup($name) {
        $groupVarPrefix = self::groupVarPrefix($name);
        foreach(SessionStorage::getAll() as $key => $value) {
            if (strpos($key, $groupVarPrefix) === 0) {
                SessionStorage::delete($key);
            }
        }
    }

    public static function clear() {
        foreach(SessionStorage::getAll() as $key => $value) {
            if (strpos($key, self::$FLASH_MESSAGE_PREFIX) === 0) {
                SessionStorage::delete($key);
            }
        }
    }

    private static function varName($name, $groupName = null) {
        if ($groupName == null) {
            return self::$FLASH_MESSAGE_PREFIX . self::$VAR_PREFIX . $name;
        }
        return self::groupVarPrefix($groupName) . $name;
    }

    private static function groupVarPrefix($groupName) {
        return self::$FLASH_MESSAGE_PREFIX . self::$GROUP_PREFIX . $groupName . self::$VAR_PREFIX;
    }
}
