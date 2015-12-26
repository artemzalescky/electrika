<?php

namespace ph\constants;

class UserRole {
    const SYSTEM = 1;
    const ADMIN = 2;
    const GUEST = 3;

    public static function getName($id) {
        switch ($id) {
            case 1:
                return 'System';
            case 2:
                return 'Admin';
            case 3:
                return 'Guest';
            default:
                return null;
        }
    }
}
