<?php

namespace ph\sessions\flash;

interface FlashMessagesAccessor {

    function add($name, $value, $groupName = null);

    function addGroup($groupName, $messages = null);

    function get($name, $groupName = null);

    function safeGet($name);

    function delete($name);

    function contains($name);

    function getGroup($name);

    function safeGetGroup($name);

    function deleteGroup($name);
    
    function clear();
}
